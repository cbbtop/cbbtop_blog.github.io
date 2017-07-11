<?php
namespace Admin\Model;

class LoopModel extends \Think\Model
{ 
    //自动验证
    protected $_validate = [
        //写的都是数据表中相对应的字段
        ['img_title', 'require', '轮播图主题不能为空'],
        ['loop_img', 'require', '请上传图片',['','',1]],
        ['parent_id', 'require', '父类名不能为空'],
        ['son_id', 'require', '子类名不能为空'],
    ];
    function getData()
    { 
        $arr = $this->select();
        foreach ($arr as $k=>$v) { 
            //处理添加时间、父类名和子类名
            $type = M('Type');
            $arr[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
            $arr[$k]['parent_name'] = $type->where(['id'=>$v['parent_id']])->getField('name');
            $arr[$k]['son_name'] = $type->where(['id'=>$v['son_id']])->getField('name');
        }

        return $arr;
    } 
}