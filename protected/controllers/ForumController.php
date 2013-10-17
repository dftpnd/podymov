<?php
// это все контроллер, ищим тут нужный нам экшен
//легче всего искать через ctrl+f
class ForumController extends Controller
{
    public $title_controller = 'Форум';
    public $href_controller = '/forum';

    public function actionIndex()
    {

        if (isset($_GET['tag_id'])) {
            $tag_id = $_GET['tag_id'];
        } else {
            $tag_id = 0;
        }

        $title = 'Форум';
        $tags = Tag::model()->findAll();
        $tags_ar = array();


        $dataProvider = new CActiveDataProvider('ForumTag', ForumTag::model()->search($tag_id, false));

        foreach ($tags as $tag) {
            $tags_ar[$tag->id]['count'] = ForumTag::model()->countByAttributes(array('tag_id' => $tag->id));
            $tags_ar[$tag->id]['name'] = $tag->name;
        }


        MyHelper::render($this, 'index', array(
            'tags' => $tags_ar,
            'dataProvider' => $dataProvider

        ), $title);
    }

    public function actionOpenUpdateForum($id)
    {
        $tags = array();
        $tags_base = Tag::model()->findAll();

        if (!empty($id)) {
            $forum = Forum::model()->findByPk($id);
            if ($forum->user_id != Yii::app()->user->id) {
                echo json_encode(array('status' => 'error', 'text' => 'Это не ваш пост'));
                die();
            }
        } else {
            $forum = new Forum();
        }

        foreach ($tags_base as $tag_base)
            $tags[] = $tag_base->name;

        $html = $this->renderPartial('_open_update_forum',
            array(
                'id' => $id,
                'forum' => $forum

            ), true);

        echo json_encode(array('html' => $html, 'status' => 'success', 'tags' => $tags));
    }

    public function actionUpdateForum($id)
    {
        if (empty($_POST['Forum']['tags']) || empty($_POST['Forum']['title']) || empty($_POST['Forum']['content'])) {
            echo json_encode(array('status' => 'error', 'text' => 'Не все поля заполены'));
            exit();
        }

        $forum = new Forum();
        $forum->title = $_POST['Forum']['title'];
        $forum->content = $_POST['Forum']['content'];
        $forum->created = time();
        $forum->user_id = Yii::app()->user->id;

        if (!$forum->save()) {
            echo json_encode(array('status' => 'error', 'text' => 'Непредвиденная ошибка'));

            exit();
        }

        $at = array();
        $tags_base = Tag::model()->findAll();
        foreach ($tags_base as $tag_base) {
            $at[$tag_base->id] = $tag_base->name;
        }


        $tags = explode(", ", $_POST['Forum']['tags']);
        // бегу по тегам которые пришли постом
        foreach ($tags as $tag) {
            if ($tag != '') {
                $tag = mb_strtolower($tag, "UTF-8");

                if (in_array($tag, $at)) {
                    $tag_id = array_search($tag, $at);
                } else {
                    $create_tag = new Tag();
                    $create_tag->name = $tag;
                    $create_tag->save();
                    $tag_id = $create_tag->id;
                }


                //тэги которые дожны быть в посте
                $forum_tag_id[] = $tag_id;

            }
        }

        $array_aft = array();
        $avalible_forum_tag = ForumTag::model()->findAllByAttributes(array('forum_id' => $forum->id));
        foreach ($avalible_forum_tag as $avalible_ft)
            $array_aft[$avalible_ft->id] = $avalible_ft->id;

        // $array_aft все теги с данны форумом
        // $forum_tag_id тэги которые пришли постом


        foreach ($forum_tag_id as $fit) {
            if (!isset($array_aft[$fit])) {
                $m = new ForumTag();
                $m->forum_id = $forum->id;
                $m->tag_id = $fit;
                $m->save();
            }
        }

        foreach ($array_aft as $asd) {
            if (!isset($forum_tag_id[$asd])) {
                ForumTag::model()->deleteAllByAttributes(array('forum_id' => $forum->id, 'tag_id' => $asd));
            }
        }

        echo json_encode(array('status' => 'success'));
    }

    public function actionView($id)
    {

        $title = "Обсуждения";

        $forum = Forum::model()->findByPk($id);
        $forum->view++;
        $forum->save(false);

        $dataProvider = new CActiveDataProvider('ForumTag', ForumTag::model()->search(false, $id));

        $forum_tag = ForumTag::model()->findAllByAttributes(array('forum_id' => $id));

        $comments = ForumComment::model()->findAllByAttributes(array('forum_id' => $id));


        $crumbs[1]['href'] = '/forum/view?id=' . $id;
        $crumbs[1]['title'] = $forum->title;

        //все что тебе нужно, это посмотреть как правило в конец функции
        //тут находится функция рендер
        // в которую передается путь ко вьюхе)
        MyHelper::render($this, '/forum/view', array(
            'forum_tag' => $forum_tag,
            'comments' => $comments,
            'dataProvider' => $dataProvider,
            'forum_id' => $id

        ), $title, $crumbs);

    }

    public function actionNewForumComment()
    {


        $new_comment = new ForumComment();

        $new_comment->forum_id = $_POST['forum_id'];
        $new_comment->text = $_POST['comment_text'];
        $new_comment->created = time();
        $new_comment->user_id = Yii::app()->user->id;
        $new_comment->save();

        echo json_encode(array('status' => 'success'));

    }

    public function actionDeleteForum($id)
    {


        $forum = Forum::model()->findByPk($id);
        if ($forum->user_id != Yii::app()->user->id) {
            echo json_encode(array('status' => 'error', 'text' => 'Это не ваш пост'));
            die();
        }

        $forum->delete();
        ForumTag::model()->deleteAllByAttributes(array('forum_id' => $id));

        echo json_encode(array('status' => 'success'));

    }

}