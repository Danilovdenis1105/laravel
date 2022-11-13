<x-app-layout>
    <x-slot:header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot:header>
    <x-slot:slot>
        <div class="mx-auto py-16">
            <div class="text-center mx-auto">
                <a
                    href="{{ route('blog.admin.categories.create') }}"
                    class="border border-indigo-500 bg-indigo-500 text-white rounded-md px-4 py-2 m-2 transition
                    duration-500 ease select-none hover:bg-indigo-600 focus:outline-none focus:shadow-outline"
                >
                    Add Category
                </a>
            </div>
        </div>
        <div class="max-w-2xl mx-auto my-3.5 ">
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            #
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Parent
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paginator as $item)
                        @php /** @var \App\Models\BlogCategory $item */@endphp
                        <tr
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                {{ $item->id }}
                            </th>
                            <td class="px-6 py-4">
                                <a href="{{ route('blog.admin.categories.edit', $item->id)  }}"
                                   class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                                    {{ $item->title }}
                                </a>
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->parentTitle }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if($paginator->total() > $paginator->count())
            <div class="max-w-2xl mx-auto">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex items-center -space-x-px">
                        {{ $paginator->links() }}
                    </ul>
                </nav>
            </div>
        @endif
    </x-slot:slot>
</x-app-layout>
