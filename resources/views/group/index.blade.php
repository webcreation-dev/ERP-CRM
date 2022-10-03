@extends('layouts.app')

@section('content')

<div class="row">
  @if (session('status'))
  <div  class="alert alert-danger alert-sm col-md-8 col-md-offset-2">
    <center>{!! session('status') !!} </center>
  </div>
  @endif
</div>
<div class="container container-content">
  <div class="row">
    <div class="col-md-8 "><span class="listTitle">Gestion de l'entreprise</span> </div>
    <div class="col-md-4">
      <!--<a href="{{url('/groups/create')}}" class="btn btn-primary btn-sm pull-right"><span class="glyphicon glyphicon-plus-sign"></span> Nouvelle Structure</a>-->
    </div>
  </div>
  <hr>
  <div class="row">
   <div class="col-md-12">
    <table class="table table-hover table-responsive table-striped listTable-express">
      <thead>
        <tr>
          <th>N°</th>
          <th>Nom</th>
          <th>Email</th>
          <th>RCCM/IFU</th>
          <th>Téléphones</th>
          <th>Services</th>
          <th>Logo</th>
          <th></th>

        </tr>
      </thead>
      <tbody id="tablbody">
        @foreach ($groups as $group)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$group->name }} </td>
          <td>{{$group->email}} </td>
          <td>{{$group->identification}} </td>
          <td>{{$group->phones}} </td>
          <td>{{$group->service}} </td>
          <td>@if( $group->picture )<img width="50" src="{{url('public/images/'.$group->picture) }}" alt="image"> @endif</td>

          <td>
           <a title="Modifier" class="btn btn-small btn-info btn-xs" href="{{ route('groups.edit',$group)}}"><span class="glyphicon glyphicon-edit"></span>Mettre à jour</a>
         </td>
         <!--<td>
          <form onsubmit="return deleteConfirmation();" action="{{route('groups.destroy',$group)}}" method="POST">
           {{ csrf_field() }}
           {{ method_field('DELETE') }}
           <button title="supprimer" type="submit" class=" btn btn-danger btn-sm">
            x</button>
          </form>
        </td>-->
      </tr>
      @endforeach
    </tbody>

    <tfoot></tfoot>
  </table>
  {{ $groups->links() }}
</div>
</div>

</div>
@endsection

