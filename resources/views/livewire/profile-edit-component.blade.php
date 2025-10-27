<div class="w-full flex flex-row gap-6 bg-gray-800 bg-opacity-70 relative rounded-lg px-8 py-8">
    <div class="flex flex-col gap-2 items-center w-full max-w-[185px]">
        @if (!$image)
            <img onclick="document.getElementById('imageInput').click()" id="image" class="w-40 h-40 hover:cursor-pointer rounded-full object-cover" src="{{ Storage::url($user->profile_pic) }}">
        @else
            <img onclick="document.getElementById('imageInput').click()" id="image" class="w-40 h-40 hover:cursor-pointer rounded-full object-cover" src="{{ $image->temporaryUrl() }}">
        @endif
        <input id="imageInput" type="file" accept="image/*" wire:model="image" class="hidden">       
        <div class="flex flex-col items-center bg-gray-900 px-4 py-2 rounded-xl bg-opacity-30">
            <p class="w-full max-w-40 text-center text-white text-sm">Tamanho Recomendado</p>
            <p class="text-white font-medium">1024x1024 <span class="text-xs">(Max 5Mb)</span></p>
        </div>
    </div>
    <div class="flex flex-col w-full gap-4">
        <div class="flex flex-row gap-4">
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="nickname">Apelido <span class="text-gray-400 opacity-75">(5)</span></label>
                <input class="p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="nickname" name="nickname" wire:model="nickname" type="text" value="{{ $user->nickname }}" maxlength="25" required>
            </div>
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="username">Usuário <span class="text-gray-400 opacity-75">(5)</span></label>
                <input class="p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="username" name="username" wire:model="username" type="text" value="{{ $user->username }}" maxlength="30" required oninput="this.value = this.value.replace(/\s/g, '');">
            </div>
        </div>
        <div class="flex flex-row gap-4">
            <div class="flex flex-col gap-2 w-full">
                <label class="text-white font-medium" for="email">Email</label>
                <input class="p-2 bg-gray-700 rounded-lg text-white focus:ring-0 focus:outline-none" id="email" name="email" wire:model="email" type="email" value="{{ $user->email }}" required>
            </div>
        </div>
        <div class="w-full flex flex-row justify-between">
            @if($errors->any())
                <p class="text-red-500 text-sm sm:text-base">Preencha todos os campos corretamente</p>
            @else
                <span></span>
            @endif
            <button type="button" wire:click="save" class="bg-white text-neutral-900 font-medium w-fit justify-self-end px-4 py-3 rounded-xl">Confirmar</button>
        </div>
        
    </div>       
</div>