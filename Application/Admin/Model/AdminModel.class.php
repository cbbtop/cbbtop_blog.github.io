<?php
namespace Admin\Model;

class AdminModel extends \Think\Model
{ 
    //自动验证
    protected $_validate = [
        //写的都是数据表中相对应的字段
        ['user_name', 'require', '用户名不能为空'],
        ['user_name', '/\w{4,16}/', '用户名不合法'],//自己定义正则
        ['user_name', '', '用户名已经存在', 0, 'unique'],
        ['password2','password','两次密码不一致',0,'confirm'],
    ];
    function getData()
    { 
        $arr = $this->select();
        $sex = ['保密','女','男'];
        foreach ($arr as $k=>$v) { 
            $arr[$k]['sex'] = $sex[$v['sex']];
            //处理添加时间
            $arr[$k]['addtime'] = date('Y-m-d H:i:s',$v['add_time']);
            
            //处理管理员角色

            //1.通过管理员id查出管理员角色id
            $rid = join(',', M('AdminRole')->where(['uid'=>$v['admin_id']])->getField('rid', true));
            //2.通过管理员角色id查出管理员角色名
            $roleName = join(',', M('Role')->where(['role_id'=>['in', $rid]])->getField('role_name', true));
            //3.将查出的管理员名称写入数组
            $arr[$k]['roleName'] = $roleName;
        }

        return $arr;
    } 
}