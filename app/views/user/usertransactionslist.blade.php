<table>
    <thead>
        <td>Transaction ID</td>
        <td>Date</td>
        <td>Direction</td>
        <td>Ammount</td>
    </thead>
    <tbody>
@foreach ( $data['transactions'] as $transaction )
        <tr>
            <td>{{ $transaction->id }}</td>
            <td>{{ $transaction->date }}</td>
            <td>{{ $transaction->transaction_direction }}</td>
            <td>{{ $transaction->ammount }}</td>
        </tr>
@endforeach
    </tbody>
</table>