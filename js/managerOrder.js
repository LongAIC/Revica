$(document).ready(function() {
    $(".productcode_column .action").click(function(){
        var $boxExtend = $(this).closest(".box_extend");
        var $productcodeColumn = $boxExtend.find(".productcode_column");
        var $childOfOrder = $boxExtend.find(".childoforder");
        
        var number_of_extend = $boxExtend.find(".extend").length;
        var height_of_extend = $boxExtend.find(".extend").height();
        
        if($productcodeColumn.hasClass("active")){
            $productcodeColumn.removeClass("active");
            $childOfOrder.css("display", "none");
            $(this).text("Chi tiết");
        }
        else{
            // Đóng nội dung của các action khác
            $(".productcode_column .action").each(function() {
                var $otherBoxExtend = $(this).closest(".box_extend");
                if ($otherBoxExtend.is($boxExtend)) {
                    return; // Bỏ qua box hiện tại
                }
                var $otherProductcodeColumn = $otherBoxExtend.find(".productcode_column");
                var $otherChildOfOrder = $otherBoxExtend.find(".childoforder");
                
                $otherProductcodeColumn.removeClass("active");
                $otherChildOfOrder.css("display", "none");
                $(this).text("Chi tiết");
            });
            
            // Mở nội dung của action hiện tại
            $productcodeColumn.addClass("active");
            $childOfOrder.css("display", "block");
            $(this).text("Thu gọn");
        }
    });
});


$(document).ready(function () {
    if (window.location.hash) {
        var targetTabId = window.location.hash.substr(1);
        var targetContentId = targetTabId.replace("tab-", "content-");

        $(".order_tab_header").removeClass("order_active_tab");
        $(".order_tab_content").removeClass("order_active_content");

        $("#" + targetTabId).addClass("order_active_tab");
        $("#" + targetContentId).addClass("order_active_content");
    }

    $(".order_tab_header").click(function () {
        $(".order_tab_header").removeClass("order_active_tab");
        $(".order_tab_content").removeClass("order_active_content");

        $(this).addClass("order_active_tab");
        var targetContentId = $(this).attr("id").replace("tab-", "content-");
        $("#" + targetContentId).addClass("order_active_content");

        history.pushState(null, null, "#" + $(this).attr("id"));
    });
});
jQuery(".form-group .show-btn").click(function() {
    if ($(this).hasClass("active")) {
        $(this).closest(".form-group").find(".form-control").attr("type", 'password');
        $(this).removeClass("active");
    } else {
        $(this).closest(".form-group").find(".form-control").attr("type", 'text');
        $(this).addClass("active");
    }
});

jQuery(document).ready(function ($) {
    $('#tel').on('input', function () {
        var phonenumber = $(this).val();
        var isPhoneNumber = /^\d{10}$/.test(phonenumber);
        var phoneInput = $(this);
        
        if (isPhoneNumber) {
            phoneInput.css({
                'border-color': '#dbb54b',
                'box-shadow': '0 0 0 2px rgba(206, 155, 37, .2)',
                'border-right-width': '1px',
                'outline': '0'
            });
        } else {
            phoneInput.css({
                'border-color': '#ff7875',
                'box-shadow': '0 0 0 2px rgba(255,77,79,.2)',
                'border-right-width': '1',
                'outline': '0'
            });
        }
    });
});