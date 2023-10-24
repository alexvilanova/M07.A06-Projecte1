<div id="flash" class="p-4">
  @if ($message = Session::get('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ $message }}</span>
    </div>
  @endif
  @if ($message = Session::get('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ $message }}</span>
    </div>
  @endif
  @if ($message = Session::get('warning'))
    <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ $message }}</span>
    </div>
  @endif
  @if ($message = Session::get('info'))
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative" role="alert">
      <span class="block sm:inline">{{ $message }}</span>
    </div>
  @endif
  @if ($errors->any())
    @foreach ($errors->all() as $error)
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ $error }}</span>
      </div>
    @endforeach
  @endif
</div>
