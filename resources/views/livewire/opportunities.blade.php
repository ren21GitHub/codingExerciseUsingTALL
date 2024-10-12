<!-- Items per page selection -->
<div>
    <div>
        <form class="mb-2">
            <input wire:model.live.debounce="searchText" type="text" placeholder="Search" class="bg-slate-800">
            <button
                class="px-2 py-2 ml-1 text-white border border-gray-500 bg-sky-700 disabled:bg-sky-900 hover:bg-sky-400" 
                wire:click.prevent="clear()"
                {{empty($searchText) ? 'disabled' : ''}}>
                Clear
            </button>
        </form>
        @if (empty($results))
        <label for="perPage">Items per page:</label>
        <select wire:model.live="perPage" id="perPage" name="perPage" class="mb-3 bg-slate-800 per-page">
            @foreach($options as $option)
            <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>
        @endif
    </div>
    <div class="mb-3">
        <!-- Pagination links -->

        @if (empty($results))
            {{ $items->links() }}              
        @endif
        
    </div>
    <!-- Items list -->
    <div class="mb-3">
        <table class="w-full">
            <thead class="text-lg text-gray-400 uppercase bg-gray-700">
                <tr>
                    <th class="px-6 py-3">
                        Name   
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (empty($results))
                    @foreach($items as $item)
                    <tr class="bg-gray-800 border-b border-gray-700 ">
                        <td class="px-6 py-3">
                            {{ $item->name }}                            
                        </td>
                    </tr>
                    @endforeach
                @else
                    @foreach($results as $result)
                    <tr class="bg-gray-800 border-b border-gray-700 ">
                        <td class="px-6 py-3">
                            {{ $result->name }}                            
                        </td>
                    </tr>
                    @endforeach
                @endif
                   
            </tbody>
        </table>
        <div class="mt-3">
            <!-- Pagination links -->
            @if(empty($results))
                {{ $items->links(data: ['scrollTo' => false]) }}     
            @endif       
        </div>
    </div>

</div>