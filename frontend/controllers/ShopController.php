<?php

namespace frontend\controllers;

use Yii;
use frontend\models\ProductApi;
use frontend\models\InventoryApi;
use frontend\models\AddressApi;
use frontend\helpers\Sku;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use common\data\APIDataProvider;
use yii\data\ArrayDataProvider;
use common\helpers\Tools;

/**
 * Site controller
 */
class ShopController extends Controller
{

    public $layout = "main-shop";

    public function actionIndex()
    {
        $userId = Yii::$app->user->getId();

        $search = Yii::$app->request->get('search');
              
        $search= replace_specialChar($search);

        $model = new ProductApi($userId);

        $shop = 'ftzmall';//#todo hardcode by caoqi 

        $pageinfo = Yii::$app->request->get('page');

        $facets = Yii::$app->request->get('facets');

        $orderby = Yii::$app->request->get('orderby');

        $price = Yii::$app->request->get('price');

        $params = array();
        //todo by caoqi
        if (isset($price) && !empty($price))
        {
            $params["range"]["rangeField"] = "price";
            $params["range"]["rangeFrom"] = !empty($price[0])?$price[0]:0;
            $params["range"]["rangeTo"] = !empty($price[1])?$price[1]:999999;
            $params['rangeFrom'] = $price[0];//由于后端不支持单独输入价格上限或者下限查询，所以加个参数显示输入价格;
            $params['rangeTo'] = $price[1];
        }

        if (isset($orderby) && !empty($orderby))
        {
            switch ($orderby)
            {
                case 4: //价格从高到低                 
                    $params["sort"]["sortField"] = "sorted_price";
                    $params["sort"]["sortType"] = "desc";
                    $params["orderby"] = 4;
                    break;
                case 5: //价格从低到高
                    $params["sort"]["sortField"] = "sorted_price";
                    $params["sort"]["sortType"] = "asc";
                    $params["orderby"] = 5;
                    break;
                case 6: //商品从新到旧
                    $params["sort"]["sortField"] = "start_date";
                    $params["sort"]["sortType"] = "desc";
                    $params["orderby"] = 6;
                    break;
                //一期不支持销量排序
            }
        }
       
        if (isset($pageinfo) && !empty($pageinfo))
        {
            $params["pageinfo"]["currentPage"] = $pageinfo;
            $params["pageinfo"]["pageSize"] = 20;
        }

        $productsfacets ="";

        if (isset($facets) && !empty($facets))
        {
            $params["facet"] = $facets;
            $facets = urldecode($facets);
            $arr = explode('|', $facets);
            $array = explode(',', $arr[1]);
            $productsfacets = $array[0];            //前台要求显示商品类型
            foreach ($array as $k => $a)
            {
                $params["facets"][$arr[0]][] = $a;

            }
        }

        if (isset($search) && !empty($search))
        {
            $params['term'] = $search;
        }                
        
        $dataProvider = $model->getProByTermWithP($params);       
        $products = $dataProvider->getModels();
   
        if (!$products)
        {
            return $this->render('/search/empty');
        }

        $salestype = Yii::$app->params['sm']['store'];
        $productsyb = array();
        $productskj = array();
        foreach ($products as $k => $p)
        {
            $products[$k]['desc']['fullImage'] = Tools::qnImg($p['desc']['fullImage'], 244, 250);
            if (!empty($p['parentCatentries'])) {
                $products[$k]['id'] = $p['parentCatentries'][0]['id']; //对于子sku商品，在推荐页的链接应该跳转到product上
            }
            foreach ($salestype['key'] as $key => $s)
            {
                if ($p['salesType'] == $s)
                {
                    $products[$k]['saletype'] = $key;
                    switch ($products[$k]['saletype'])
                    {
                        case "ybmyDig":
                            $productsyb[] = $p;
                            break;
                        case "ybmyGyx":
                            $productsyb[] = $p;
                            break;
                        case "hw":
                            $productskj[] = $p;
                            break;
                        case "kjbhZy":
                            $productskj[] = $p;
                            break;
                        case "kjbhFx":
                            $productskj[] = $p;
                            break;
                    }
                }
            }
        }

        $productall[0]['productskj'] = $productskj;
        $productall[0]['productsyb'] = $productsyb;
   
        $facets = $dataProvider->extdata;
        $totalcount = $dataProvider-> getTotalCount();       
        $totalpage = ceil($totalcount/20);
        $pageinfo = isset($pageinfo)?$pageinfo:1;
        
        $product = new ArrayDataProvider([
            'allModels' => $productall,
        ]);       
        
         $product2 = new ArrayDataProvider([
            'allModels' => $products,
        ]);    

        return $this->render('/shop/index', [
            'product' => $product2,     //如果不需要分开一般贸易与自贸产品，则用'product' => $product2,如果需要分开一般贸易与自贸产品，则用'product' => $product,
            //'productsyb' => $productsyb,
            //'productskj' => $productskj,
            'productsfacets' => $productsfacets,
            'dataProvider' => $dataProvider,
            'facets' => $facets,
            'searchData' => $params,            
            'totalcount' => $totalcount,
            'totalpage' => $totalpage,
            'pageinfo' => $pageinfo,
            ]
        );
    }

}



function replace_specialChar($strParam){
    $regex = "/\/|\~|\!|\@|\#|\\$|\%|\^|\&|\*|\(|\)|\_|\+|\{|\}|\:|\<|\>|\?|\[|\]|\,|\.|\/|\;|\'|\`|\-|\=|\\\|\|/";
    return preg_replace($regex,"",$strParam);
}

