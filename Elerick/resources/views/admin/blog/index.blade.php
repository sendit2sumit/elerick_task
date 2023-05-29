<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Blogs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body>
    @if(Session::has('message'))
    <h3 class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</h3>
    @endif
    <div class="container">
        <h1 class="text-center">Blogs List</h1>
       <a href="{{ route('admin.blogs.create') }}"> <button class="btn btn-primary"> + Add Blog</button></a>
       <a href="{{ route('admin.logout') }}"> <button class="btn btn-primary"> Log out</button></a>
        <br><br>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @forelse ($blogs as $blog)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $blog->title ?? '' }}</td>
                    <td>{{ $blog->description ?? '' }}</td>
                    <td>
                        <a href="{{ route('admin.blogs.edit', [base64_encode($blog->id)]) }}"
                            class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('admin.blogs.destroy', [base64_encode($blog->id)]) }}"
                            method="post">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>
                    </td>
                  </tr>
                @empty
                <tr>
                    <td>
                        <p class="text-center">No blog found!</p>
                    </td>
                </tr>
                @endforelse

            </tbody>
          </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
