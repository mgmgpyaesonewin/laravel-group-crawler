<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupRequest;
use App\Http\Requests\PostRequest;
use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $posts = Post::with('comments', 'groups')->latest()->get();
        return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PostRequest $request
     * @return JsonResponse
     */
    public function store(PostRequest $request)
    {
        $data = $request->validated();
        $post= Post::create([
            'profile_name' => $data['profile_name'],
            'profile_link' => $data['profile_link'],
            'link' => $data['link'],
            'text' => $data['text'],
            'posted_date' => Carbon::parse($data['posted_date']),
            'type' => $data['type'],
            'group_id' => $data['group_id'],
        ]);
        if ($data['type'] !== 'text') {
            foreach ($data['attachments'] as $attachment) {
                Attachment::create([
                    'link' => $attachment,
                    'post_id' => $post->id
                ]);
            }
            foreach ($data['comments'] as $comments) {
                Comment::create([
                    'name' => $comments['name'],
                    'text' => $comments['text'],
                    'post_id' => $post->id
                ]);
            }
        }
        return response()->json([
            'id' => $post->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function show(Post $post)
    {
        return response()->json($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param GroupRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(GroupRequest $request, Post $post)
    {
        $post->update($request->validated());
        return response()->json([
            'message' => 'Updated Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return JsonResponse
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json([
            'message' => 'Delete Successfully',
        ]);
    }
}