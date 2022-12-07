@if($reviews->isNotEmpty())
    <table class="table table-striped table-hover table-sm">
        <thead>
        <tr>
            <th>Product</th>
            <th>Comment</th>
            <th>Rating</th>
            <th>Reviewed On</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviews as $review)
            <tr>
                <td>{{ $review->product->name }}</td>
                <td>{{ $review->comment }}</td>
                <td>{{ $review->rating }}</td>
                <td>{{ $review->created_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-center">No reviews given yet.</h4>
@endif
