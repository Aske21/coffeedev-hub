<?php

require_once dirname(__FILE__). '/BaseService.class.php';
require_once dirname(__FILE__).'/../dao/FollowersDao.class.php';

class FollowersService extends BaseService{


    // initializing variable to be false
    public $isFollowing = False;

    public function follow(){

        if ($userid != $followerid) {

            if (!DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                    if ($followerid == 6) {
                            DB::query('UPDATE users SET verified=1 WHERE id=:userid', array(':userid'=>$userid));
                    }
                    DB::query('INSERT INTO followers VALUES (\'\', :userid, :followerid)', array(':userid'=>$userid, ':followerid'=>$followerid));
            } else {
                    echo 'Already following!';
            }
            $isFollowing = True;
    }
    }

    public function un_follow(){
        if (isset($_POST['unfollow'])) {

            if ($userid != $followerid) {

                    if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
                            if ($followerid == 6) {
                                    DB::query('UPDATE users SET verified=0 WHERE id=:userid', array(':userid'=>$userid));
                            }
                            DB::query('DELETE FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid));
                    }
                    $isFollowing = False;
            }
    }
    if (DB::query('SELECT follower_id FROM followers WHERE user_id=:userid AND follower_id=:followerid', array(':userid'=>$userid, ':followerid'=>$followerid))) {
            //echo 'Already following!';
            $isFollowing = True;
    }
    }
   
}

?>