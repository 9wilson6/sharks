<?php

namespace App\Http\Controllers;

use App\Page;
use App\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;

class PagesController extends Controller
{
    use SEOToolsTrait;

    public function store(Request $request){
        $sections = $request->all();
        foreach ($sections as $key => $section) {
            //Get slug
            $slu = explode('--', $key);
            $thepages = Page::where('slug', $slu[1])->get();
            if ($thepages->isEmpty()) {
                return response()->json([
                    'message', 'There was a prolem updating your page, Does not exist in the database'
                ], 400);
            }
            $thepage = Page::where('slug', $slu[1])->first();
            $updatepage = Page::find($thepage->id);
            $updatepage->update([
                'content' => $section
            ]);
        }
        return response()->json([
            'message', 'Sections were updated successfully'
        ], 200);      
    }

    // Pages below are about homework bubble
    public function home() {
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        return view('frontend.pages.index', compact('subjects'));
    }

    public function about() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/about-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $about = Page::where('slug', 'about')->get();
        if ($about->isEmpty()) {
            Page::create([
                'slug' => 'about',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'about')->first();
        return view('frontend.pages.about', compact('page'));
    }

    public function contact() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/contact-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $contact = Page::where('slug', 'contact')->get();
        if ($contact->isEmpty()) {
            Page::create([
                'slug' => 'contact',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'contact')->first();
        return view('frontend.pages.contact', compact('page'));
    }

    public function hiw() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/how-it-works');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $hiw = Page::where('slug', 'hiw')->get();
        if ($hiw->isEmpty()) {
            Page::create([
                'slug' => 'hiw',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'hiw')->first();
        return view('frontend.pages.how-it-works', compact('page'));
    }

    public function latest_orders() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/latest-orders');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $latest_orders = Page::where('slug', 'latest_orders')->get();
        if ($latest_orders->isEmpty()) {
            Page::create([
                'slug' => 'latest_orders',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'latest_orders')->first();
        return view('frontend.pages.latest-orders', compact('page'));
    }

    public function our_writers() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/our-writers');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $our_writers = Page::where('slug', 'our_writers')->get();
        if ($our_writers->isEmpty()) {
            Page::create([
                'slug' => 'our_writers',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'our_writers')->first();
        return view('frontend.pages.our-writers', compact('page'));
    }

    // Homework bubble legal

    public function privacy() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/contact-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $privacy = Page::where('slug', 'privacy')->get();
        if ($privacy->isEmpty()) {
            Page::create([
                'slug' => 'privacy',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'privacy')->first();
        return view('frontend.legal.privacy', compact('page'));
    }

    public function cookie_policy() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/contact-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $cookie_policy = Page::where('slug', 'cookie_policy')->get();
        if ($cookie_policy->isEmpty()) {
            Page::create([
                'slug' => 'cookie_policy',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'cookie_policy')->first();
        return view('frontend.legal.cookie-policy', compact('page'));
    }

    public function money_back() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/contact-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $money_back = Page::where('slug', 'money_back')->get();
        if ($money_back->isEmpty()) {
            Page::create([
                'slug' => 'money_back',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'money_back')->first();
        return view('frontend.legal.money-back-guarantee', compact('page'));
    }

    public function tos() {
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/contact-us');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $tos = Page::where('slug', 'tos')->get();
        if ($tos->isEmpty()) {
            Page::create([
                'slug' => 'tos',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'tos')->first();
        return view('frontend.legal.tos', compact('page'));
    }  

    public function assignment_help(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/assignment-help');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $assignment_help = Page::where('slug', 'assignment_help')->get();
        if ($assignment_help->isEmpty()) {
            Page::create([
                'slug' => 'assignment_help',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'assignment_help')->first();
        return view('frontend.services.assignment-help', compact('subjects', 'page'));
    }

    public function article_review(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/article-review');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $article_review = Page::where('slug', 'article_review')->get();
        if ($article_review->isEmpty()) {
            Page::create([
                'slug' => 'article_review',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'article_review')->first();
        return view('frontend.services.article-review', compact('subjects', 'page'));
    }

    public function buy_essay(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/buy-essay');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $buy_essay = Page::where('slug', 'buy_essay')->get();
        if ($buy_essay->isEmpty()) {
            Page::create([
                'slug' => 'buy_essay',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'buy_essay')->first();
        return view('frontend.services.buy-essay', compact('subjects', 'page'));
    }

    public function write_my_essay(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/write-my-essay');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $write_my_essay = Page::where('slug', 'write_my_essay')->get();
        if ($write_my_essay->isEmpty()) {
            Page::create([
                'slug' => 'write_my_essay',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'write_my_essay')->first();
        return view('frontend.services.write-my-essay', compact('subjects', 'page'));
    }

    public function persuasive_essay(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/persuasive-essay');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $persuasive_essay = Page::where('slug', 'persuasive_essay')->get();
        if ($persuasive_essay->isEmpty()) {
            Page::create([
                'slug' => 'persuasive_essay',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'persuasive_essay')->first();
        return view('frontend.services.persuasive-essay', compact('subjects', 'page'));
    }

    public function buy_research_papers(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/buy-research-papers');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $buy_research_papers = Page::where('slug', 'buy_research_papers')->get();
        if ($buy_research_papers->isEmpty()) {
            Page::create([
                'slug' => 'buy_research_papers',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'buy_research_papers')->first();
        return view('frontend.services.buy-research-papers', compact('subjects', 'page'));
    }

    public function argumentative_essay(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/argumentative-essay');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $argumentative_essay = Page::where('slug', 'argumentative_essay')->get();
        if ($argumentative_essay->isEmpty()) {
            Page::create([
                'slug' => 'argumentative_essay',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'argumentative_essay')->first();
        return view('frontend.services.argumentative-essay', compact('subjects', 'page'));
    }

    public function scholarship_essay(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/scholarship-essay');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $scholarship_essay = Page::where('slug', 'scholarship_essay')->get();
        if ($scholarship_essay->isEmpty()) {
            Page::create([
                'slug' => 'scholarship_essay',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'scholarship_essay')->first();
        return view('frontend.services.scholarship-essay', compact('subjects', 'page'));
    }

    public function buy_thesis_paper(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/buy-thesis-paper');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $buy_thesis_paper = Page::where('slug', 'buy_thesis_paper')->get();
        if ($buy_thesis_paper->isEmpty()) {
            Page::create([
                'slug' => 'buy_thesis_paper',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'buy_thesis_paper')->first();
        return view('frontend.services.buy-thesis-paper', compact('subjects', 'page'));
    }

    public function case_study_help(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/case-study-help');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $case_study_help = Page::where('slug', 'case_study_help')->get();
        if ($case_study_help->isEmpty()) {
            Page::create([
                'slug' => 'case_study_help',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'case_study_help')->first();  
        return view('frontend.services.case-study-help', compact('subjects', 'page'));
    }

    public function dissertation_writing(){
        $subjects = Subjects::get();
        $this->seo()->setTitle(defaultsettings()['sitename']. ': Essay writing help for students');
        $this->seo()->setDescription('We help students achieve high grades in their exams buy guiding them on how to write academic papers');
        $this->seo()->opengraph()->setUrl(defaultsettings()['siteurl'].'/dissertation-writing');
        $this->seo()->opengraph()->addProperty('type', 'page');
        $this->seo()->twitter()->setSite('@studyace');
        $this->seo()->jsonLd()->setType('Page');
        $dissertation_writing = Page::where('slug', 'dissertation_writing')->get();
        if ($dissertation_writing->isEmpty()) {
            Page::create([
                'slug' => 'dissertation_writing',
                'content' => '<p>Add content here</p>',
            ]);
        }
        $page = Page::where('slug', 'dissertation_writing')->first();        
        return view('frontend.services.dissertation-writing', compact('subjects', 'page'));
    }
}
