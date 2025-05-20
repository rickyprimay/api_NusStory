<?php

namespace App\Http\Controllers\Api\Historical;

use App\Http\Controllers\Controller;
use App\Models\HistoricalTopics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Http\Resources\HistoricalTopicResource;

class HistoricalTopicsController extends Controller
{
    private function convertToEmbedUrl($url)
    {
        $videoId = null;

        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches)) {
            $videoId = $matches[1];
        }

        if ($videoId) {
            return 'https://www.youtube.com/embed/' . $videoId;
        }

        return $url;
    }

    public function index()
    {
        $figures = HistoricalTopics::with(['province', 'city'])->paginate(10);

        $data = HistoricalTopicResource::collection($figures)->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => 'Historical Topics Retrieved Successfully',
            'data' => $data['data'],
            'links' => $data['links'],
            'meta' => $data['meta'],
        ]);
    }

    public function getById($id)
    {
        $historicalTopic = HistoricalTopics::with(['province', 'city'])->find($id);

        if (!$historicalTopic) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Historical Topic Not Found',
                    'data' => [],
                ],
                404,
            );
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'Historical Topic Get By Id Retrieved Successfully',
                'data' => new HistoricalTopicResource($historicalTopic),
            ],
            200,
        );
    }

    public function getBySlug($slug)
    {
        $historicalTopic = HistoricalTopics::with(['province', 'city'])
            ->where('slug', $slug)
            ->first();

        return response()->json(
            [
                'success' => true,
                'message' => 'Historical Topic Get By Slug Retrieved Successfully',
                'data' => new HistoricalTopicResource($historicalTopic),
            ],
            200,
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'required|file|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation Error',
                    'data' => $validator->errors(),
                ],
                400,
            );
        }

        $data = $request->all();
        $data['slug'] = Str::slug($data['title']);
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_topics', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_topics/' . $filename);
        }

        $historicalTopic = HistoricalTopics::create($data);

        return response()->json(
            [
                'success' => true,
                'message' => 'Historical Topic Created Successfully',
                'data' => $historicalTopic,
            ],
            200,
        );
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
            'thumbnail' => 'nullable|file|image',
            'video_url' => 'required',
            'province_id' => 'required|exists:provinces,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Validation Error',
                    'data' => $validator->errors(),
                ],
                400,
            );
        }

        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Historical Topic Not Found',
                    'data' => [],
                ],
                404,
            );
        }

        $data = $request->all();
        $data['video_url'] = $this->convertToEmbedUrl($data['video_url']);

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('historical_topics', $filename, 'public');
            $data['thumbnail'] = url('storage/historical_topics/' . $filename);
        }

        $historicalTopic->update($data);

        return response()->json(
            [
                'success' => true,
                'message' => 'Historical Topic Updated Successfully',
                'data' => $historicalTopic,
            ],
            200,
        );
    }

    public function destroy($id)
    {
        $historicalTopic = HistoricalTopics::find($id);

        if (!$historicalTopic) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Historical Topic Not Found',
                    'data' => [],
                ],
                404,
            );
        }

        $historicalTopic->delete();

        return response()->json(
            [
                'success' => true,
                'message' => 'Historical Topic Deleted Successfully',
            ],
            200,
        );
    }
}
