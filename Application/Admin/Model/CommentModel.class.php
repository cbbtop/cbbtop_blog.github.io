<?php
namespace Admin\Model;

class CommentModel extends \Think\Model
{ 
    //自动验证
        protected $_validate = [ 
            ['reply','require','请输入评论内容'],
            ['reply','/^.{15,120}$/','请输入10-120个任意字符'],
        ];

    function getData()
    { 
        $arr = $this->select();
        foreach ($arr as $k=>$v) { 
            //处理添加时间
            $arr[$k]['add_time'] = date('Y-m-d H:i:s',$v['add_time']);
            
            //处理评价商品
            $goods_id = $this->getField('goods_id',true);
            //通过商品id查询出商品名
            $goods = M('Goods');
            $goods_name = $goods->where(['goods_id'=>['in',$goods_id]])->getField('goods_name',true);
            $arr[$k]['goodsName'] = $goods_name[$k];
            //处理评价等级
            switch ($arr[$k]['goods_rank'])
            { 
                case 1:
                    $arr[$k]['star'] = '一星';
                    break;
                case 2:
                    $arr[$k]['star'] = '二星';
                    break;
                case 3:
                    $arr[$k]['star'] = '三星';
                    break;
                case 4:
                    $arr[$k]['star'] = '四星';
                    break;
                case 5:
                    $arr[$k]['star'] = '五星';
                    break;
            }          
        }
        return $arr;
    } 
}