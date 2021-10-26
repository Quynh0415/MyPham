$(document).on('click', '.btn-menu-fixed' , function(){
    $(this).addClass('active'); 
    $('.menu').addClass('show');  
});  
$(document).on('click', '.btn-menu-fixed.active' , function(){
    $(this).removeClass('active');
    $('.menu').removeClass('show');
}); 
$(window).scroll(function () { 
    let header = $('header').height();
    if( $(window).scrollTop() > 20 ){
        $('header').addClass('fixed');        
    }else{
        $('header').removeClass('fixed');  
    }
});

function formatMoney(amount, decimalCount = 2, decimal = ".", thousands = ",") {
    try {
        decimalCount = Math.abs(decimalCount);
        decimalCount = isNaN(decimalCount) ? 2 : decimalCount;

        const negativeSign = amount < 0 ? "-" : "";

        let i = parseInt(amount = Math.abs(Number(amount) || 0).toFixed(decimalCount)).toString();
        let j = (i.length > 3) ? i.length % 3 : 0;

        return negativeSign + (j ? i.substr(0, j) + thousands : '') + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands) + (decimalCount ? decimal + Math.abs(amount - i).toFixed(decimalCount).slice(2) : "");
    } catch (e) {
        console.log(e);
    }
}