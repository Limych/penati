<?php 

namespace Penati\Http\Controllers;

use Penati\Offer;

class OfferController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
    
  }

    /**
     * Display the specified resource.
     *
     * @param  string  $agent
     * @param  string  $offer
     * @return Response
     */
  public function show($agent, $offer)
  {
      $offer = Offer::whereSlug($offer)->first();
      $tmp = $agent;
      $agent = $offer->agent()->first();
      if ($agent->slug !== $tmp) {
          abort(404);
      }

      return view('offer', compact('offer', 'agent'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
    
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
    
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    
  }
  
}
