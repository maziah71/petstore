<h1> Jadual Solat Bagi Bulan {{ date ("F Y")}}</h1>


<pre>
Tempat: {{ $place}}
Pembekal: {{ $provider}}
</pre>

<table border="1">
    <thead>
        <tr>
            <td>Hb</td>
            <td>Subuh</td>
            <td>Syuruk</td>
            <td>Zuhur</td>
            <td>Asar</td>
            <td>Maghrib</td>
            <td>Isyak</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($prayer_times as $i => $ptime)
        <tr>
            <td>{{ $i +1 }}</td>
            <td>{{ date('G:i a',$ptime[0]) }}</td>
            <td>{{ date('G:i a',$ptime[1]) }}</td>
            <td>{{ date('G:i a',$ptime[2]) }}</td>
            <td>{{ date('G:i a',$ptime[3]) }}</td>
            <td>{{ date('G:i a',$ptime[4]) }}</td>
            <td>{{ date('G:i a',$ptime[5]) }}</td>
        </tr>
        @endforeach
    <tbody>
</table>