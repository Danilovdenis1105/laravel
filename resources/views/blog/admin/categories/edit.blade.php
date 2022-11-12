<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot:header>
    <x-slot:slot>
        @php /** @var \App\Models\BlogCategory $item */ @endphp
        <form method="POST" action="{{ route('blog.admin.categories.update', $item->id) }}">
            @method('PATCH')
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
                            <label for="title" class="text-lx font-serif">Title:</label>
                            <input type="text" value="{{ $item->title }}" placeholder="title" name="category[title]"
                                   class="ml-2 outline-none py-1 px-2 text-md border-2 rounded-md"/>
                        </div>
                        <div>
                            <label for="title" class="text-lx font-serif">Slug:</label>
                            <input type="text" value="{{ $item->slug }}" placeholder="title" name="category[slug]"
                                   class="ml-2 outline-none py-1 px-2 text-md border-2 rounded-md"/>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-lg font-serif">Description:</label>
                            <textarea name="category[description]" cols="30" rows="10" placeholder="whrite here.."
                                      class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md">{{  old('category.description', $item->description) }}</textarea>
                        </div>
                        <div>
                            <label for="description" class="block mb-2 text-lg font-serif">Parent Category:</label>
                            <select name="category[parent_id]"
                                    class="w-full font-serif  p-4 text-gray-600 bg-indigo-50 outline-none rounded-md">
                                @foreach($categoryList as $categoryOption)
                                    <option value="{{ $categoryOption->id }}"
                                            @selected($item->parent_id === $categoryOption->id)>
                                        {{ $categoryOption->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit"
                                class=" px-6 py-2 mx-auto block rounded-md text-lg font-semibold text-indigo-100 bg-indigo-600  ">
                            ADD Category
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </x-slot:slot>
</x-app-layout>
