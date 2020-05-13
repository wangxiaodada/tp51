;(function($){
    $.fn.MySelect=function(){
        this.each(function(){
            var $box=$(this);
            var $input=$box.find("input.my-select-input");  //输入框
            var $list=$input.next();                          //ul装扮成下拉框
            var inputHeight=$input.outerHeight();   //计算input输入框的高度和宽度，方便定位ul和设置ul及包裹元素的宽度
            //var inputWidth=$input.innerWidth();
            $list.css({"top":(inputHeight)});
            //$box.width($input.outerWidth());
            //
            // $input.blur(function (e) {
            //    console.log("离开了");
            //     $(".my-select-list").hide();
            // });

            $input.focus(function(){   //输入框获得焦点后，显示下拉选择ul

                var $nextUl=$(this).next();
                if($nextUl.children().length>0){
                    $(this).next().show();
                }
            }).bind('input propertychange',function(){  //绑定监测输入框的输入值更改
                var $this=$(this);
                $this.attr("data-id","");
                var curText=$this.val();
                var $nextUl=$(this).next();
                if($nextUl.children().length>0){
                    $nextUl.find("li").removeClass("choosed");
                    $nextUl.find("li").each(function(i,item){
                        var txt=$(item).text();
                        if(txt===curText){
                            var v=$(item).attr("data-value");
                            $this.attr("data-id",v);
                            $(item).addClass("choosed");
                        }
                    });
                }
            });
            //$list.find("li").click(function () {
            //    var $this = $(this);
            //    var value = $this.attr("data-value") || '';
            //    $input.val($this.text()).attr("data-id", value);
            //    $this.addClass("choosed").siblings().removeClass("choosed");
            //    $this.parent().hide();
            //});
            //修改成如下事件绑定，为了给动态添加的li也可以产生点击效果
            $list.off('click', 'li').on('click', 'li', function (e) {
                var $this = $(this);
                var value = $this.attr("data-value") || '';
                $input.val($this.text()).attr("data-id", value);
                $this.addClass("choosed").siblings().removeClass("choosed");
                $this.parent().hide();
            });
        });

        $(document).click(function (e) {  //点击.my-select-box范围外时隐藏ul下拉框
            var target=e.target;
            var $target=$(target);
            var $parent=$target.closest('.my-select-box');
            if($parent.length<1){  //说明不是.my-select-box范围内点击，将ul隐藏
                $(".my-select-list").hide();
            }else if($parent.length==1){  //如果存在多个my-select-box的情况，将其余的非这项以外的都隐藏
                var $ul=$parent.find(".my-select-list");
                var flag=$ul.is(":hidden");
                $(".my-select-list").hide();
                if(!flag) $ul.show();
            }
        });
        return this;
    };

})(jQuery);

$(".my-select-box").MySelect();