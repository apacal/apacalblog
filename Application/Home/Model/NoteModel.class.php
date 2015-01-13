<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 10/9/14
 * Time: 7:53 PM
 */

namespace Home\Model;
use Admin\Model\UserModel;
use Think\Model;

class NoteModel extends Model {

    public function getNoteList($cid) {
        $tagNoteList = cacheTag(NoteList);
        if (false === ($list = getCache($tagNoteList))) {
            $User = new UserModel();
            $Comment = new CommentModel();
            $list = $this->order('createtime desc')->select();
            foreach ($list as &$val) {
                $userInfo = $User->getUserInfo($val['uid']);
                if (is_array($userInfo)) {
                    $val['name'] = $userInfo['name'];
                    $val['image'] = $userInfo['image'];
                    $val['userUrl'] = U('user/' .$val['uid'] .C('URL_HASH'));
                }

            }


            setCache($tagNoteList, $list, C('NOTE_TTL'));
        }

        return $list;
    }

} 
