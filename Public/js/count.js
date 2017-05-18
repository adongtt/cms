/**
 * 计数器js文件
 */
var newsIds={};
$(".news_count").each(function(i){
    newsIds[i]=$(this).attr("news-id");
});

var url="/index.php?c=index&a=getCount";

$.post(url,newsIds,function(result){
	if(result.status==1)
		{
			/**
			 *  $.each函数 
			 */
			counts=result.data;
			$.each(counts,function(news_id,val){
               $('.node-'+news_id).html(val);
			});
		}

},'JSON');