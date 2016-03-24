/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var t = urlArray.time;
var inter = setInterval(timecount, 1000);
function timecount()
{
    t--;
    document.getElementById("timeid").innerHTML = t;
    if (t <= 0)
    {
        location.href = urlArray.home;
        clearInterval(inter);
    }

}