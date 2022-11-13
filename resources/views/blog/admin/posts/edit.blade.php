<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot:header>
    <x-slot:slot>
        @php /** @var \App\Models\BlogPost $item */ @endphp
        @if($item->exists)
            <form method="POST" action="{{ route('blog.admin.posts.update', $item->id) }}">
            @method('PATCH')
        @else
            <form method="POST" action="{{ route('blog.admin.posts.store') }}">
        @endif
                @csrf
                @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp
                @if($errors->any())
                    <div class="bg-red-100 border-t border-b border-red-500 text-red-700 px-4 py-3" role="alert">
                        @foreach ($errors->all(':message') as $error)
                            <p class="font-bold">{{ $error }}</p>
                        @endforeach
                    </div>
                @endif
                @if(session('success'))
                    <div class="bg-green-100 border-t border-b border-green-500 text-green-700 px-4 py-3" role="alert">
                        {{ session()->get('success') }}
                    </div>
                @endif
                <div class="bg-indigo-50 min-h-screen md:px-20 pt-6">
                    <div class=" bg-white rounded-md px-6 py-10 max-w-2xl mx-auto">
                        <div class="space-y-4">
                            <div>
                                <label for="post[title]" class="text-lx font-serif">Title:</label>
                                <input type="text" value="{{ $item->title }}" placeholder="title" name="post[title]"
                                       class="ml-2 outline-none py-1 px-2 text-md border-2 rounded-md"/>
                            </div>
                            <div>
                                <label for="post[slug]" class="text-lx font-serif">Slug:</label>
                                <input type="text" value="{{ $item->slug }}" placeholder="slug" name="post[slug]"
                                       class="ml-2 outline-none py-1 px-2 text-md border-2 rounded-md"/>
                            </div>
                            <div>
                                <label for="post[content_raw]" class="block mb-2 text-lg font-serif">Content Raw:</label>
                                <textarea name="post[content_raw]" cols="30" rows="10" placeholder="whrite here.."
                                          class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md">{{  old('post.content_raw', $item->content_raw) }}</textarea>
                            </div>
                            <div>
                                <label for="post[excerpt]" class="block mb-2 text-lg font-serif">Excerpt:</label>
                                <textarea name="post[excerpt]" cols="15" rows="5" placeholder="whrite here.."
                                          class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md">{{  old('post.excerpt', $item->excerpt) }}</textarea>
                            </div>
                            <div>
                                <label for="post[category_id]" class="block mb-2 text-lg font-serif">Category:</label>
                                <select name="post[category_id]"
                                        class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md">
                                    @foreach($categoryList as $categoryOption)
                                        <option value="{{ $categoryOption->id }}"
                                            @selected($item->category_id === $categoryOption->id)>
                                            {{ $categoryOption->id_with_title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center justify-center">
                                <input
                                    name="post[is_published]"
                                    type="hidden"
                                    value="0"
                                    class="appearance-none w-9 focus:outline-none checked:bg-blue-300 h-5 bg-gray-300 rounded-full before:inline-block before:rounded-full before:bg-blue-500 before:h-4 before:w-4 checked:before:translate-x-full shadow-inner transition-all duration-300 before:ml-0.5"
                                />
                                <label for="post[is_published]" class="block mb-2 text-lg font-serif">Is Published:</label>
                                <input
                                    name="post[is_published]"
                                    type="checkbox"
                                    value="1"
                                    class="appearance-none w-9 focus:outline-none checked:bg-blue-300 h-5 bg-gray-300 rounded-full before:inline-block before:rounded-full before:bg-blue-500 before:h-4 before:w-4 checked:before:translate-x-full shadow-inner transition-all duration-300 before:ml-0.5"
                                    @checked($item->is_published)
                                />
                            </div>
                            <button type="submit"
                                    class=" px-6 py-2 mx-auto block rounded-md text-lg font-semibold text-indigo-100 bg-indigo-600  ">
                                ADD Post
                            </button>
                        </div>
                    </div>
                </div>
            </form>
                    <form method="POST" action="{{ route('blog.admin.posts.destroy', $item->id) }}">
                        @method('DELETE')
                        @csrf
                        <button type="submit"
                                class=" px-6 py-2 mx-auto block rounded-md text-lg font-semibold text-indigo-100 bg-indigo-600  ">
                            Delete Post
                        </button>
                    </form>
    </x-slot:slot>
</x-app-layout>
