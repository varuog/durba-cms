<?php

namespace Varuog\DurbaCms\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Varuog\DurbaCms\Models\CmsPage;
use Varuog\DurbaCms\Services\CmsService;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    protected CmsService $cmsService;

    public function __construct(CmsService $cmsService)
    {
        $this->cmsService = $cmsService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dump(auth()->user());
        // dd('s');
        $filter = request()->query('filter', []);
        $cmsPages = $this->cmsService->search($filter, [], 10);

        //dd($filter);
        return view('DurbaCms::cms.list', compact('cmsPages', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('DurbaCms::cms.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CmsPage $cmspage)
    {
        return view('DurbaCms::cms.show', compact('cmspage'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CmsPage $cmspage)
    {
        return view('DurbaCms::cms.edit',  compact('cmspage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CmsPage $cmspage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CmsPage $cmspage)
    {
        dd('ss');
        $oldCmsPage = $this->cmsService->delete($cmspage);
        return redirect('admin.cmspage.index');
    }
}
