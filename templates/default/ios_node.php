<?php 
if (!defined('IN_SAESPOT')) exit('error: 403 Access Denied'); 

echo '
<div class="title">
        <i class="fa fa-angle-double-right"></i> ',$c_obj['name'],'(',$c_obj['articles'],')';
	if($cur_user['notic']){
            $notic_n = count(array_unique(explode(',', $cur_user['notic'])))-1;
	echo'<span class="nopic"><a href="/notifications"><i class="fa fa-bell"></i> 您有',$notic_n,'条消息</a></span>';
	}
echo '    <div class="c"></div>
</div>

<div class="main-box home-box-list">';

if($c_obj['about']){
    echo '<div class="post-list grey"><div class="nodesm">',$c_obj['about'],'</div></div>';
}

foreach($articledb as $article){
echo '
<div class="post-list">
    <div class="item-avatar"><a href="/user/',$article['uid'],'">
    <img src="/avatar/normal/',$article['uavatar'],'.png" alt="',$article['author'],'" /></a></div>
    <div class="item-content count',$article['comments'],'">
        <h1><a href="/topics/',$article['id'],'">',$article['title'],'</a></h1>
        <span class="item-date">';
if($article['comments']){
    echo '<i class="fa fa-user"></i> <a href="/user/',$article['ruid'],'">',$article['rauthor'],'</a>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> ',$article['edittime'],'回复';
}else{
    echo '<i class="fa fa-user"></i> <a href="/user/',$article['uid'],'">',$article['author'],'</a>&nbsp;&nbsp;<i class="fa fa-clock-o"></i> ',$article['addtime'],'发表';
}
echo '        </span>
    </div>';
if($article['comments']){
    $gotopage = ceil($article['comments']/$options['commentlist_num']);
    if($gotopage == 1){
        $c_page = '';
    }else{
        $c_page = '/'.$gotopage;
    }
    echo '<div class="item-count"><a href="/topics/',$article['id'],$c_page,'#reply',$article['comments'],'">',$article['comments'],'</a></div>';
}
echo '    <div class="c"></div>
</div>';

}

if($c_obj['articles'] > $options['list_shownum']){ 

echo '<div class="pagination">';
if($page>1){
echo '<a href="/nodes/',$cid,'/',$page-1,'" class="float-left"><i class="fa fa-angle-double-left"></i> 上一页</a>';
}
echo '<div class="pagediv">';
$begin = $page-4;
$begin = $begin >=1 ? $begin : 1;
$end = $page+4;
$end = $end <= $taltol_page ? $end : $taltol_page;

if($begin > 1)
{
	echo '<a href="/nodes/',$cid,'/1" class="float-left">1</a>';
	echo '<a class="float-left">...</a>';
}
for($i=$begin;$i<=$end;$i++){
	
	if($i != $page){
		echo '<a href="/nodes/',$cid,'/',$i,'" class="float-left">',$i,'</a>';
	}else{
		echo '<a class="float-left pagecurrent">',$i,'</a>';
	}
}
if($end < $taltol_page)
{
	echo '<a class="float-left">...</a>';
	echo '<a href="/nodes/',$cid,'/',$taltol_page,'" class="float-left">',$taltol_page,'</a>';
}

echo '</div>';
if($page<$taltol_page){
echo '<a href="/nodes/',$cid,'/',$page+1,'" class="float-right">下一页 <i class="fa fa-angle-double-right"></i></a>';
}
echo '<div class="c"></div>
</div>';
}
echo '</div>';

?>