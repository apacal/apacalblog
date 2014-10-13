<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 10/9/14
 * Time: 7:53 PM
 */

namespace Home\Model;
use Think\Model;

class NoteModel extends Model {
    public function getNoteList() {
        $tagNoteList = cacheTag(NoteList);
        if (false === ($list = getCache($tagNoteList))) {
            $sql = "select id, ablg_note.createtime as time,content,adminname,image from ablg_note left join ablg_admin on ablg_note.adminid=ablg_admin.adminid order by time desc";
            $list = $this->query($sql);

            setCache($tagNoteList, $list, C('NOTE_TTL'));
        }

        return $list;
    }

} 
