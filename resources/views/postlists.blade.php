<ul class="post-lists">
    @foreach ($posts as $post)
        <li>
            <div class="content">
                <div class="post-lists-header">
                    <div class="profile">
                        <div class="profile-icon"><img src="{{ asset(Storage::url($post->user->profile_icon_photo)) }}"></div>
                        <div class="profile-name">{{ $post->user->name }}</div>
                    </div>
                </div>
                <div class="post-lists-contents">
                    <div class="caption">{{ $post->comment }}</div>
                    <div class="image">
                        <ul>
                            @if ($post->image1)
                                <li style="background-image: url({{ asset(Storage::url($post->image1)) }})"></li>
                            @endif
                            @if ($post->image2)
                                <li style="background-image: url({{ asset(Storage::url($post->image2)) }})"></li>
                            @endif
                            @if ($post->image3)
                                <li style="background-image: url({{ asset(Storage::url($post->image3)) }})"></li>
                            @endif
                            @if ($post->image4)
                                <li style="background-image: url({{ asset(Storage::url($post->image4)) }})"></li>
                            @endif
                        </ul>
                    </div>
                    <div class="reference">{{ $post->time_difference }}</div>
                </div>
                <div class="post-lists-comment">
                    <div class="profile">
                        <div class="profile-icon"><img src="{{ asset(Storage::url($post->user->profile_icon_photo)) }}"></div>
                    </div>
                    <div class="comment">{{ $post->comment }}</div>
                </div>
                <div class="post-lists-bottom">
                    <div class="favorite">136 Like</div>
                </div>
            </div>
        </li>
    @endforeach
</ul>
