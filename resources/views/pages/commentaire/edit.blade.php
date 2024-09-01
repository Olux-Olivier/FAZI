<h1>Mon le commentaire</h1>
<form method="post" action="{{route('commentaire.update', $commentaire->id)}}">
    @csrf
    @method('put')
    <textarea name="message"  id="" cols="30" rows="10">{{old('content',$commentaire->message)}}</textarea>
    <input type="hidden" name="user_id" value="{{\Illuminate\Support\Facades\Auth::user()->id}}">
    <input type="submit" value="Modifier">
</form>
