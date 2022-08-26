@if ($data->user_id !== Auth::user()->id)
<script>
alert('잘못된 경로입니다.');
location.href = '/';    
</script>  
@endif