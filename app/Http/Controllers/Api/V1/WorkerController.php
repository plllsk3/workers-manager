<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Resources\Api\V1\WorkerResource;
use App\Http\Requests\Api\V1\StoreWorkerRequest;
use App\Http\Requests\Api\V1\UpdateWorkerRequest;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WorkerResource::collection(Worker::latest()->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkerRequest $request)
    {
        $phone = new Phone(['phone' => $request->phone]);

        $worker = Worker::create($request->except(['phone']));

        $worker->phone()->save($phone);

        return (new WorkerResource($worker))
            ->additional(['message' => __('notifications.store.success')])
            ->response()
            ->setStatusCode(\Illuminate\Http\Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $worker = Worker::findOrFail($id);

        return new WorkerResource($worker);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkerRequest $request, $id)
    {
        $worker = Worker::findOrFail($id);

        $phone = Phone::find($worker->phone['id']);

        $worker->update($request->except(['phone']));

        $phone->update(['phone' => $request->phone]);

        return (new WorkerResource($worker->fresh()))
            ->additional(['message' => __('notifications.update.success')])
            ->response()
            ->setStatusCode(\Illuminate\Http\Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $worker
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Worker::findOrFail($id)->delete();

        return response()
            ->json(['message' => __('notifications.destroy.success'),])
            ->setStatusCode(\Illuminate\Http\Response::HTTP_OK);
    }
}
