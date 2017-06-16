

/**
 *  Ajax通用提交表单
 *  @var  form表单的id属性值  form_id
 *  @var  提交地址 subbmit_url
 */
function post_form(form_id,subbmit_url){
    if(form_id == ''){
        alert('缺少必要参数');
        return false;
    }
    if(!subbmit_url){
        //  默认取当前地址  加上ajax请求标示
        subbmit_url = location.href + '/is_ajax/1';
    }
    //  序列化表单值
    var data = $('#'+form_id).serialize();
    $.post(subbmit_url,data,function(result){
        var obj = $.parseJSON(result);
        if(obj.status == 0){
            //alert(obj.msg);
            return false;
        }
        if(obj.status == 1){
            //alert(obj.msg);
            if(obj.data.return_url){
                //  返回跳转链接
                location.href = obj.data.return_url;
            }else{
                //  刷新页面
                location.reload();
            }
            return;
        }
    })
}
// 修改指定表的指定字段值
function ajaxUpdateField(obj){
	 var table = $(obj).data('table');
	 var id = $(obj).data('id');			 
	 var field = $(obj).attr('name').replace(/field_/ig,""); // 字段名字
	 var value = $(obj).val();				 
	 $.ajax({
		 type:'POST',
		 data:{table:table,id:id, field:field,value:value}, 
		 url:"/admin/Goods/updateField",
		 success:function(data){					 
				  layer.msg('修改成功', {icon: 1,time:1000});
			 }        
	 });			 
}
