@props(['comments','story'])

<ul class="space-y-3">
    @foreach ($comments as $c)
        <li id="comment-{{ $c->id }}" class="flex gap-2">
            <div class="h-8 w-8 rounded-full bg-stone-200 flex items-center justify-center text-[10px]">
                {{ strtoupper(mb_substr($c->user->name ?? 'U', 0, 1)) }}
            </div>

            <div class="flex-1 leading-tight"
                x-data="{ showEdit:false, showReply:false, body:@js($c->body) }">

                <div class="flex items-center gap-2">
                    <span class="font-medium">{{ $c->user->name }}</span>
                    <span class="text-[11px] text-stone-500">{{ $c->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-1 whitespace-pre-line text-[15px]" x-show="!showEdit" x-cloak x-text="body"></p>

                @auth
                    @if (auth()->id() === $c->user_id)
                        <form x-show="showEdit" x-cloak method="POST"
                            action="{{ route('comments.update', $c) }}"
                            class="space-y-2 mt-1">
                            @csrf @method('PATCH')
                            <textarea name="body" rows="3"
                                    class="w-full rounded-lg border p-2 text-[15px]"
                                    x-model="body" required></textarea>
                            <div class="flex gap-2">
                                <button class="rounded-lg bg-stone-900 text-white px-3 py-1.5 text-sm">Išsaugoti</button>
                                <button type="button" class="rounded-lg border px-3 py-1.5 text-sm"
                                        @click="showEdit=false">Atšaukti</button>
                            </div>
                        </form>
                    @endif
                @endauth

                <div class="mt-1 flex items-center gap-3 text-[13px] text-stone-600">
                    @auth
                        <button class="hover:underline" @click="showReply = !showReply">Atsakyti</button>

                        @if (auth()->id() === $c->user_id)
                            <button class="hover:underline" @click="showEdit = !showEdit">Redaguoti</button>

                            <form method="POST" action="{{ route('comments.destroy', $c) }}" class="inline"
                                onsubmit="return confirm('Ištrinti komentarą?');">
                                @csrf @method('DELETE')
                                <button class="hover:underline">Ištrinti</button>
                            </form>
                        @endif
                    @endauth
                </div>

                @auth
                <div x-show="showReply" x-cloak class="mt-2">
                    <form method="POST" action="{{ route('stories.comments.store', $story) }}" class="space-y-2">
                        @csrf
                        <input type="hidden" name="parent_id" value="{{ $c->id }}">
                        <textarea name="body" rows="3" class="w-full rounded-lg border p-2 text-[15px]"
                                placeholder="Parašykite atsakymą..." required></textarea>
                        <div class="flex justify-end">
                            <button class="rounded-lg border px-3 py-1.5 text-sm">Atsakyti</button>
                        </div>
                    </form>
                </div>
                @endauth

                @if ($c->children->isNotEmpty())
                    <div class="mt-3 ml-4 pl-3 border-l border-stone-200">
                        @include('stories.comments._list', ['comments' => $c->children, 'story' => $story])
                    </div>
                @endif
            </div>
        </li>
    @endforeach
</ul>