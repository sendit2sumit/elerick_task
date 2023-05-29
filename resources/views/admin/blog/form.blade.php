<!DOCTYPE html>
<html>
<body>
    @if(Session::has('message'))
    <h3 class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</h3>
    @endif
<h2> {{ isset($blog) ? 'Update' : 'Create' }} Blog</h2>
@php $action = isset($blog) ? route('admin.blogs.update', [$blog->id]) : route('admin.blogs.store'); @endphp
<form action="{{ $action }}" method="POST">
    @if (isset($blog))
    @method('PUT')
    @endif
    @csrf
  <label for="title">Title:</label><br>
  <input type="text" id="fname" name="title" value="{{ old('title', $blog->title ?? '') }}"><br>
  @error('title')
  <span class="validation">{{ $message }}</span>
  @enderror
  <label for="description">Description:</label><br>
  <textarea name="description" id="" cols="30" rows="10">{{ old('description', $blog->description ?? '') }}</textarea><br>
  @error('description')
  <span class="validation">{{ $message }}</span>
  @enderror
  <br><br>
  <input type="submit" value="Submit">
</form>
</body>
</html>

