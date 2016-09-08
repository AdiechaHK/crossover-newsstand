<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NewsRequest;
use App\Http\Requests;
use App\Models\News;
use Storage;
use Fpdf;
use Auth;

class NewsController extends Controller
{

    protected static $PAGE_SIZE = 10;

    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'feeds', 'show', 'export_pdf']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View('news/index')->with(
            [
                'list' => News::where('publish', 1)
                    ->orderBy('event_at', 'desc')
                    ->take(self::$PAGE_SIZE)->get()
            ]);
    }

    public function user_news($page = 0)
    {
        $user = Auth::user();

        $list = $user->news()
            ->orderBy('event_at', 'desc')
            ->skip($page * self::$PAGE_SIZE)
            ->take(self::$PAGE_SIZE)
            ->get();

        return View('news/index')->with(compact('list'));
    }

    public function feeds(Request $request)
    {
        $list = $this->get_more_feeds();
        return $request->format == "json"? response()->json(compact('list')): View('rss/feeds')->with(compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return View('news/new');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {

        $path = $request->save_image();

        $user = Auth::user();

        $user->news()->create([
            'title'   => $request->title,
            'text'    => $request->text,
            'image'   => $path
        ]);

        return redirect($request->path())->with('notification', 'Article created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $top_news = News::where('id', '!=', $id)->orderBy('event_at', 'desc')->take(5)->get();
        return View("news/show")->with(['news' => News::find($id), 'top_news' => $top_news]);
    }


    public function export_pdf($id) {

        $news = News::find($id);
        $dt = " - " . $news->event_at();

        Fpdf::AddPage();
        Fpdf::SetFont('Arial','B',24);
        Fpdf::Write(10, $news->title);
        Fpdf::Ln();
        Fpdf::SetFont('Arial',null,12);
        Fpdf::Write(10, "- Published by " . $news->publisher()->first()->name . $dt);
        Fpdf::Line(0, 33, 210, 33);
        Fpdf::Ln();
        Fpdf::Image($news->image, 10, 40, 180, 150);
        Fpdf::Ln(165);
        Fpdf::Write(10, $news->text);
        Fpdf::Ln();

        $binary = base64_decode(Fpdf::Output());

        return (new Response($binary, 200))
            ->header('Content-type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="' . $news->title . ' news.pdf"');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        News::destroy($id);
        return redirect('/news')->with('notification', "Deleted successfully.");
    }


    // Api Service to load more news
    public function load_more($page = 0) {
        $list = $this->get_more_feeds($page);
        return View('news/list', compact('list'));
    }


    public function toggle_publish(Request $request, $id)
    {
        $toggle = News::find($id)->publish?0:1;

        News::where('id', $id)->update(['publish' => $toggle]);

        return redirect('/');
    }

    private function get_more_feeds($page = 0) 
    {
        $list = News::where('publish', 1)
            ->orderBy('event_at', 'desc')
            ->skip($page*self::$PAGE_SIZE)
            ->take(self::$PAGE_SIZE)->get();
            
        foreach ($list as $news) {
            $news['author'] = $news->publisher()->first();
        }
        return $list;        
    }

}

