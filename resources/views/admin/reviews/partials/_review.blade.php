<tr>
    <td class="column-md">
        <img src="{{ $review->image ? $review->image->url() : asset('assets/img/image-not-available.png') }}" style="width: 70px; height: 70px; object-fit: cover;" class="img-fluid" alt="{{ $review->name }}">
    </td>
    <td class="column-lg">
        {{ $review->rating }}
    </td>
    <td class="column-lg">{{ $review->status }}</td>
    <td class="column-lg">{{ $review->first_name . ' ' . $review->last_name }}</td>
    <td class="column-lg">{{ $review->email }}</td>
    <td class="column-xl">{{ $review->product_id }}</td>
    <td class="column-lg">{{ $review->created_at->diffForHumans() }}</td>
</tr>
