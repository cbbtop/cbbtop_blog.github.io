<?php
namespace Admin\Controller;
use Think\Controller;
class ContactController extends CommonController {

    // 用户反馈列表
    public function contactList(){
        // 发送邮件回复
        // $res = sendMail('$mail','主题','内容');


        $user = M('contact');
        
        // 等待处理
        if (!empty($_GET['id']) && $_GET['msg_status'] === '1'){
           // var_dump($_GET);
           $map['msg_id'] = $_GET['id'];
           $map['msg_status'] =  0;
           // var_dump($id);
           // var_dump($map);
           $res = $user->save($map);
        // 已回复
        } elseif(!empty($_GET['id']) && $_GET['msg_status'] === '0') {
           $map['msg_id'] = $_GET['id'];
           $map['msg_status'] =  1;
           $res = $user->save($map);

        }
        
        $res  = $user->select();
        $this->assign('list',$res);
        $this->display('contactList');  
    }
    // 用户反馈回复
    public function contactListAdd(){
        // phpinfo();
        // exit;
        $user = M('contact');
        $email = M('user');
        $id = $_GET['id'];
        // dump($_GET);
        $emailNumber = $email->where(['id'=>$id])->find();
        // dump($emailNumber);

        if (IS_POST){
             // 验证规则
             // 邮箱地址
            $rule=array(
            array('link_name','require','请输入商品名',1),
            array('link_name', '^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$', '邮箱地址不合法,请重新输入'),
            // 回复内容
            array('msg_reply','require','请输入回复内容',1),
            );
            if (!$user->validate($rule)->create()){
                $this->error($user->getError());
            } else{ 
                $mail               = $_POST['mail'];
                $map['msg_id']      = $_POST['id'];
                $map['msg_reply']   = $_POST['msg_reply'];
                $map['msg_status']  = 1;
                $map['repaly_time'] = time();
                $des                = $_POST['msg_reply'];
                var_dump($des);
                var_dump($mail);
                // 发送邮件回复
                // $mailres = sendMail("mk@va86.com","反馈回复","xxxx");
                $mailres = sendMail("$mail","反馈回复","$del");
                // var_dump($xxmail);
                $res = $user->save($map);
                // var_dump($mailres);
                // exit;
                if($res !== 0 && $mailres !== "ok") {
                    $this->success('发送失败！','contactList',60);    
                }else{
                // 上传成功     
                    $this->success('发送成功！','contactList',60);    
                }
            }
        } else {
            $this->assign('list',$typeList);
            $this->assign('emailNumber',$emailNumber);
            $this->display('contactListAdd'); 
        }
       
    }
    // 用户反馈删除
    public function contactListDel(){
        //批量删除:post 
        //选择删除:get
        // var_dump($_POST);
        // var_dump($_GET);
        // exit();
        $user = M('contact');
        if (IS_GET) {
            // var_dump($_GET);
            $id = $_GET['id'];   
            $res = $user->where(['msg_id'=>$id])->delete();
            // 删除操作
            if ($res) {
              $this->success('删除成功','contactList',60);
            }else {
                $this->error('删除失败','contactList',60);
            }         
        } elseif (IS_POST){
            // 功能：批量删除
            $arr = $_POST['box'];
            // var_dump($arr);
            foreach ($arr as $k => $val) {
                $id = $val;
                // echo $id;
                $res = $user->where(['msg_id'=>$id])->delete();
                // echo $res;
                if ($res) {
                       $this->success('批量删除成功','contactList',50);
                    } else {
                        $this->error('批量删除失败','contactList',50);
                }                    
            }          
        }             
    }
}
