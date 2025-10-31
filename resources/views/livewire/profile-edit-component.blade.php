<div class="w-full flex md:flex-row flex-col gap-6 bg-gray-800 bg-opacity-70 relative rounded-lg px-8 py-8">
    <div class="flex flex-col gap-2 items-center w-full md:max-w-[185px]">
        @if (!$image)
            <img onclick="document.getElementById('imageInput').click()" id="image" class="md:w-40 md:h-40 w-[140px] h-[140px] hover:cursor-pointer rounded-full object-cover" src="{{ Storage::url($user->profile_pic) }}">
        @else
            <img onclick="document.getElementById('imageInput').click()" id="image" class="md:w-40 md:h-40 w-[140px] h-[140px] hover:cursor-pointer rounded-full object-cover" src="{{ $image->temporaryUrl() }}">
        @endif
        <input id="imageInput" type="file" accept="image/*" wire:model="image" class="hidden">       
        <div class="flex flex-col items-center bg-gray-900 px-4 py-2 rounded-xl bg-opacity-30">
            <p class="w-full max-w-40 text-center text-white text-sm">Tamanho Recomendado</p>
            <p class="text-white font-medium">1024x1024 <span class="text-xs">(Max 15Mb)</span></p>
        </div>
    </div>
    <div class="flex flex-col w-full gap-4">
        <div class="flex md:flex-row flex-col gap-4">
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="nickname">Apelido <span class="text-gray-400 opacity-75">(5)</span></label>
                <input class="w-full p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="nickname" name="nickname" wire:model="nickname" type="text" value="{{ $user->nickname }}" maxlength="25" required>
            </div>
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="username">Usuário <span class="text-gray-400 opacity-75">(5)</span></label>
                <input class="w-full p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="username" name="username" wire:model="username" type="text" value="{{ $user->username }}" maxlength="30" required oninput="this.value = this.value.replace(/\s/g, '');">
            </div>
        </div>
        <div class="flex flex-row gap-4">
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="email">Email</label>
                <input class="w-full p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="email" name="email" wire:model="email" type="email" value="{{ $user->email }}" required>
            </div>
        </div>
        <div class="w-full flex flex-row justify-between">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @else
                <span></span>
            @endif
            <button type="button" wire:click="save" class="bg-white text-neutral-900 font-medium w-fit justify-self-end px-4 py-3 rounded-xl">Confirmar</button>
        </div>
        
    </div>       
</div>