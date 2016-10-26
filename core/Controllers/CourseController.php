<?php

namespace Core\Controllers;

// use \Slim\Mustache\Mustache as View;
// use \Core\Models\Lecturer;
use \Core\Models\Course;
use \Core\Options\OptionManager;
use Respect\Validation\Validator as v;
use \Core\Containers\View;
use \Core\Containers\Model;

class CourseController extends Controller{

    public function createCourseIndex($req, $res)
    {
        return $this->view->render($res, "newcourse", []);
    }

    public function editCourseIndex($req, $res, $args)
    {
        $course =  Course::with('users')->where('slug', $args['slug'])->get()->first()->toArray();
        $view = new View($res, $this);
        $model = new Model($course);

        return $view('newcourse', $model());
    }
        
    public function editCourse($req, $res)
    {
        $args = $req->getParams();
        $validation = $this->validator->validate($req, [
            'name' => v::notEmpty()->alpha(),
            'slug' => v::notEmpty()->slug()
        ]);

        if($validation->failed()){
            //faliure
        }

        $c = Course::findOrFail($args['id']);
        $c->title = $args['title'];
        $c->slug = $args['slug'];
        $c->description = isset($args['description']) ? $args['description'] : "";
        $c->video = isset($args['video']) ? $args['video'] : "";
        $c->color = isset($args['color']) ? $args['color'] : 0;
        $c->image = isset($args['image']) ? $args['image'] : "";
        $c->level = isset($args['level']) ? $args['level'] : 0;
        $c->save();

        return $res->withJson(['redirect' => '/course/' .  $c['slug']]);
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

        $c = new Course;
        $c->title = $args['title'];
        $c->slug = $args['slug'];
        $c->description = isset($args['description']) ? $args['description'] : "";
        $c->video = isset($args['video']) ? $args['video'] : "";
        $c->color = isset($args['color']) ? $args['color'] : 0;
        $c->image = isset($args['image']) ? $args['image'] : "";
        $c->level = isset($args['level']) ? $args['level'] : 0;
        $c->save();

        return $res->withJson(['redirect' => '/course/' .  $c['slug']]);
    }
    public function createLession($req, $res)
    {   

    }    
}