<h1>{{$title}}</h1>

<table>
    <tr>
        <th>First name</th>
        <th>Last Name</th>
        <th>Full Name</th>
    </tr>

@forelse ($profiles as $profile)
<tr>   
<th>{{$profile->first_name}}</th>
        <th>{{$profile->last_name}}</th>
        <th>{{$profile->full_name}}</th>
</tr>
 
    @empty
<h2>No Profiles Yet</h2>
@endforelse
 </table> 