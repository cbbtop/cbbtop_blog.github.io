<?php
namespace Admin\Model;

class AdModel extends \Think\Model
{ 
    //自动验证
    protected $_validate = [
        //写的都是数据表中相对应的字段
        ['ad_title', 'require', '广告主题不能为空'],
        ['ad_img', 'require', '请上传图片',['','',1]],
        ['ad_link', 'require', '链接地址不能为空'],
    ];
    function getData()
    { 
        $arr = $this->select();
        foreach ($arr as $k=>$v) { 
            //处理添加时间
            $arr[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
        }
        
        return $arr;
    } 
}