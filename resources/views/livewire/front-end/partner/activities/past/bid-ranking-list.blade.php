<div>
    <p>Rankings | Total Bids: {{number_format($bid_ranking->total(), 0)}}</p>
    <table class="table table-bordered table-sm text-center">
        <thead>
            <tr>
                <th scope="col">Rank</th>
                <th scope="col">Name</th>
                <th scope="col">Bid</th>
                <th scope="col">Qty</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @php
                $quan = $quantity;    
            @endphp
            @forelse ($bid_ranking as $key => $data)
            <tr>
                @php
                    $quan = $quan - $data->quantity;    
                @endphp
                <td>{{++$key}}</td>
                <td>{{$data->user_account->first_name}}</td>
                <td>₱{{number_format($data->bid, 2)}}</td>
                <td>{{number_format($data->quantity, 0)}}</td>
                <td>{{$quan >= 0  ? 'Winning' : 'Losing'}}</td>
            </tr>
            @empty
            <tr class="text-center">
                <td colspan="5">No Bids.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    {{$bid_ranking->render()}}
</div>
