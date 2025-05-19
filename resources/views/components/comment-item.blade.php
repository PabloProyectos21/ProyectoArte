@php
    $replies = $repliesGrouped[$comment->id] ?? collect();
@endphp


<div class=" mt-2 p-3 bg-gray-100 dark:bg-gray-800 rounded shadow-sm flex gap-3">
    @php
        $isUrl = Str::startsWith($comment->user->profile_picture ?? '', ['http://', 'https://']);
        $avatar = $comment->user->profile_picture
            ? ($isUrl ? $comment->user->profile_picture : secure_asset('storage/' . $comment->user->profile_picture))
            : secure_asset('images/profile_pictures/default-user.jpg');
    @endphp

    <img src="{{ $avatar }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">
    <div>
        <div class="flex items-center justify-between">
            <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $comment->user->name ?? 'Anonymous' }}</h5>
            <span class="text-xs text-gray-400 ml-2">{{ $comment->created_at->diffForHumans() }}</span>
        </div>
        <p class="text-sm text-gray-800 dark:text-gray-100 mt-1">{{ $comment->content }}</p>

        @if(Auth::check())
            <button
                class="text-sm text-blue-600 hover:underline reply-btn"
                data-comment-id="{{ $comment->id }}"
                data-user-name="{{ $comment->user->name }}">
                Reply
            </button>
            @php
                $hasLiked = auth()->check() && $comment->ratings->contains('user_id', auth()->id());
            @endphp

            <button
                data-id="{{ $comment->id }}"
                class="comment-like-btn text-sm transition {{ $hasLiked ? 'text-purple-400' : 'text-gray-500' }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="pt-2 size-7">
                    <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                </svg>

            </button>
            <span class="comment-likes-count">{{ $comment->ratings->count() }}</span>

        @endif

        @php
            $replies = $repliesGrouped[$comment->id] ?? collect();
        @endphp

        @if($replies->isNotEmpty())
            @foreach($replies as $reply)
                <div class="ml-6 mt-2 p-3 bg-gray-100 dark:bg-gray-800 rounded shadow-sm flex gap-3">
                    @php
                        $isUrl = Str::startsWith($reply->user->profile_picture ?? '', ['http://', 'https://']);
                        $avatar = $reply->user->profile_picture
                            ? ($isUrl ? $reply->user->profile_picture : secure_asset('storage/' . $reply->user->profile_picture))
                            : secure_asset('images/profile_pictures/default-user.jpg');
                    @endphp

                    <img src="{{ $avatar }}" alt="Avatar" class="w-8 h-8 rounded-full object-cover">

                    <div>
                        <div class="flex items-center justify-between">
                            <h5 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $reply->user->name ?? 'Anonymous' }}</h5>
                            <span class="text-xs text-gray-400 ml-2">{{ $reply->created_at->diffForHumans() }}</span>
                        </div>

                        <p class="text-sm text-gray-800 dark:text-gray-100 mt-1">{{ $reply->content }}</p>

                        @if(Auth::check())
                            <button
                                class="text-sm text-blue-600 hover:underline reply-btn"
                                data-comment-id="{{ $reply->id }}"
                                data-user-name="{{ $reply->user->name }}">
                                Reply
                            </button>
                            <button
                                data-id="{{ $reply->id }}"
                                class="comment-like-btn text-sm transition {{ $hasLiked ? 'text-purple-400' : 'text-gray-500' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="pt-2 size-7">
                                    <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V2.75A.75.75 0 0 1 15 2a2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
                                </svg>
                            </button>
                            <span class="comment-likes-count">{{ $reply->ratings->count() }}</span>
                        @endif
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>
