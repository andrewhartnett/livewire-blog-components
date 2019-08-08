<div class="p-6 bg-white ml-2 mr-2 shadow-xl">

    <div class="text-center border border-gray-200 p-2">
        <input type="text" class="focus:outline-none w-full" placeholder="Your post needs a title." wire:model="title">
    </div>

    @foreach($blocks as $block)
        @switch($block['type'])
            @case('h1')
            <div class="border border-dashed border-gray-300 hover:border-gray-500 mt-2 mb-2">
                <button class="text-sm text-red-300 float-right m-2 hover:text-red-500" wire:click="deleteBlock({{$loop->iteration}})">✗</button>
                @if($loop->iteration != 1)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockUp({{$loop->iteration}})">↑</button>
                @endif
                @if($loop->iteration != $loop->count)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockDown({{$loop->iteration}})">↓</button>
                @endif
                <h1>{{$block['value']}}</h1>
            </div>
            @break
            @case('paragraph')
            <div class="border border-dashed border-gray-300 hover:border-gray-500 mt-2 mb-2">
                <button class="text-sm text-red-300 float-right m-2 hover:text-red-500" wire:click="deleteBlock({{$loop->iteration}})">✗</button>
                @if($loop->iteration != 1)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockUp({{$loop->iteration}})">↑</button>
                @endif
                @if($loop->iteration != $loop->count)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockDown({{$loop->iteration}})">↓</button>
                @endif
                <p class="mt-2 mb-2">{{$block['value']}}</p>
            </div>
            @break
            @case('quote')
            <div class="border border-dashed border-gray-300 hover:border-gray-500 mt-2 mb-2">
                <button class="text-sm text-red-300 float-right m-2 hover:text-red-500" wire:click="deleteBlock({{$loop->iteration}})">✗</button>
                @if($loop->iteration != 1)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockUp({{$loop->iteration}})">↑</button>
                @endif
                @if($loop->iteration != $loop->count)
                <button class="text-sm text-blue-300 float-right m-2 hover:text-red-500 focus:outline-none" wire:click="moveBlockDown({{$loop->iteration}})">↓</button>
                @endif
                <blockquote class="p-4 bg-neutral-100 text-neutral-600 border-l-4 mt-2 mb-2 border-gray-700 italic quote">
                    <p class="mb-2">{{$block['value']}}</p>
                </blockquote>
            </div>
            @break
        @endswitch
    @endforeach

    <div class="mb-6"></div>

    @if($editingNewBlock)
        <div>
            @switch($currentBlock['type'])

            @case('h1')
            <input type="text" placeholder="Heading" wire:model="value">
            @break
            @case('paragraph')
            <textarea name="newParagraph" id="" cols="30" rows="10" placeholder="New Paragraph" wire:model="value"></textarea>
            @break
            @case('quote')
            <input type="text" placeholder="Quote text" wire:model="value">
            @break

            @endswitch

            <button wire:click="save" @if(empty($value)) disabled @endif>Save</button>
        </div>
    @else

        @if($creatingNewBlock)
            <button class="btn bg-gray-200 text-black p-2 mr-3" wire:click="newBlockType('h1')">Heading</button>
            <button class="btn bg-gray-200 text-black p-2 mr-3" wire:click="newBlockType('paragraph')">Paragraph</button>
            <button class="btn bg-gray-200 text-black p-2 mr-3" wire:click="newBlockType('quote')">Quote</button>
        @else
            <div class="mb-6">
                <button class="btn-block btn bg-blue-800 text-white p-2 hover:bg-blue-600 text-sm rounded" wire:click="newBlock">New Block</button>
            </div>

            <div class="flex flex-row justify-between">
                <a class="bg-gray-200 text-black p-2" href="/posts">Back</a>
                <button class="bg-green-500 text-white p-2" wire:click="savePost">Save Post</button>
            </div>
        @endif
    @endif
</div>