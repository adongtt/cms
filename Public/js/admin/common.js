/**
 * 
 **/
 
 $("#button-add").click(function(){
     var url=SCOPE.add_url;
     window.location.href=url;
 });

/**
 * 提交form表单
 */
 $('#singcms-button-submit').click(function(){
    var url = SCOPE.save_url;
    var data = $('#singcms-form').serializeArray();
    postData = {};

    $(data).each(function(i){
    	postData[this.name] = this.value;
    });

   $.post(url,postData,function(result){
      if(result.status == 0)
      	dialog.error(result.message);
      else
      	dialog.success(result.message,SCOPE.jump_url);
   },'JSON');
 });

/**
 * 更新操作
 */
 $(".singcms-table #singcms-edit").on('click',function(){
    var id = $(this).attr('attr-id');
    var url = SCOPE.edit_url+'&id='+id;
    window.location.href = url;
 });

/**
 * 删除操作
 */
 $(".singcms-table #singcms-delete").on('click',function(){
    var id = $(this).attr('attr-id');
    var a = $(this).attr('attr-a');
    var message = $(this).attr('attr-message');
    var url = SCOPE.set_status_url;

   data = {};
   data['id'] = id;
   data['status'] = -1;
   layer.open({
   	        type : 0,
   	        title : '是否提交?',
            content : "是否确定"+message,
            icon:3,
            closeBtn:2,
            scrollBar:true,
            btn : ['是','否'],
            yes : function(){
               return todelete(url,data);
            },
        });

 });

 function todelete(url,data)
 {
    $.post(url,data,function(result){
      if(result.status==0)
      	dialog.error(result.message,result.data);
      else
      	dialog.success(result.message,result.data);
    },'json');
 }

/**
 * 排序操作
 * @param  {[type]} ){                                   var url [description]
 * @param  {[type]} 'JSON'); }            [description]
 * @return {[type]}          [description]
 */
$('#button-listorder').click(function(){
    var url = SCOPE.listorder_url;
    var data = $('#singcms-listorder').serializeArray();
    postData = {};

    $(data).each(function(i){
      postData[this.name] = this.value;
    });
   //console.log(postData);
   $.post(url,postData,function(result){
      if(result.status == 0)
        dialog.error(result.message);
      else
        dialog.success(result.message,result.data);
   },'JSON');
 });
/*
修改状态
 */
$(".singcms-table #singcms-on-off").on('click',function(){
    var id = $(this).attr('attr-id');
    var status = $(this).attr('attr-status');
    var message = $(this).attr('attr-message');
    var url = SCOPE.set_status_url;

   data = {};
   data['id'] = id;
   data['status'] = status;
   layer.open({
            type : 0,
            title : '是否提交?',
            content : "是否确定"+message,
            icon:3,
            closeBtn:2,
            scrollBar:true,
            btn : ['是','否'],
            yes : function(){
               return todelete(url,data);
            },
        });

 });


$('#button-push').click(function(){
    var id = $('#select_push').val();
    if(id == 0)
      return dialog.error('请选择推荐位');
    var url = SCOPE.push_url;
    push = {};
    postData = {};
    $('input[name="pushcheck"]:checked').each(function(i){ 
         push[i] = $(this).val();
}); 
    postData['push'] = push;
    postData['positionid'] = id;
   //console.log(postData);
   $.post(url,postData,function(result){
      if(result.status == 0)
        dialog.error(result.message);
      else
        dialog.success(result.message,result.data);
   },'JSON');
 });