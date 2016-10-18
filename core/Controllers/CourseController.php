<?php

namespace Core\Controllers;

use \Slim\Mustache\Mustache as View;
use \Core\Models\Lecturer;
use \Core\Models\Course;
use Respect\Validation\Validator as v;

class CourseController extends Controller{
    
    public function createCourseIndex($req, $res)
    {
        return $this->view->render($res, "newcourse", []);        
    }

    public function editCourseIndex($req, $res, $args)
    {
        $course = Course::getCourse($args['slug']);
        return $this->view->render($res, "newcourse", $course);
        // return $res->withJson($r);
    }
        
    public function createCourse($req, $res)
    {   
        $args = $req->getParams();
        $validation = $this->validator->validate($req, [
            'name' => v::notEmpty()->alpha(),
            'slug' => v::notEmpty()->slug()
        ]);

        if($validation->failed()){
            //faliure
        }
        $r = Lecturer::find(1)->createCourse($req->getParams());
        
        return $res->withJson($r);
    }
}