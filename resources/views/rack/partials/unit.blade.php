<?php
$textY = $unitY - $padding;
$unitWidth = $defaultUnitWidth;
$unitHeight = $defaultUnitHeight * $unit->type->unit_height;

$portWidth = $unitHeight / (4 * $unit->type->unit_height);
$portHeight = $unitHeight / (6 * $unit->type->unit_height);

$bgColor = $unit->type->sort->color;

$name = ($unit->getIp() != "") ? "{$unit->getIp()} - {$unit->name}" : "{$unit->name} - {$unit->id}";
?>

<g id="unit_{{$unit->id}}">
    <rect x="{{ $unitX }}" y="{{ $unitY }}" width="{{ $unitWidth }}" height="{{ $unitHeight }}" class="unit" style="stroke:#000;stroke-width:1px;fill-opacity:0.7;fill:{{ $bgColor }}"></rect>
    <text x="{{ $textX }}" y="{{ $textY }}" text-anchor="end" class="unit__label">{{ $name }}</text>
</g>

<?php
$testX = $unitX + ($padding * 0.5);
$testY = $unitY;
?>
@if(!$debug)
    <g id="unit_{{ $unit->name }}_debug">
        @for ($x = 0; $x  < (6 * $unit->type->unit_height); $x++)
            @for ($y = 0; $y < 31; $y++)
                <rect x="{{ $testX }}" y="{{ $testY }}" width="{{ $portWidth }}" height="{{ $portHeight }}"
                      class="unit" style="stroke:#000;stroke-width:1px;fill-opacity: 0.0;stroke-opacity: 0.4;fill:{{ $bgColor }};"></rect>
                <?php $testX = $testX + $portWidth; ?>
            @endfor
            <?php
            $testY = $testY + $portHeight;
            $testX = $unitX + ($padding * 0.5);
            ?>
        @endfor
    </g>
@endif

<g id="ports_{{ strtolower($unit->type->sort->name)  }}_{{ $unit->id }}">';
    <?php
    $unitSort = str_slug(strtolower($unit->type->sort->name));
    $unitType = str_slug(strtolower($unit->type->name));
    $jsonFileName = 'units/' . $unitSort . '/' . $unitType . '.json';

    $json = null;
    ?>

    @if(\Storage::exists($jsonFileName))
        <?php $json = json_decode(\Storage::get($jsonFileName), true); ?>
    @endif

    @if(!empty($json))
        <?php
        $ports = $unit->ports;
        $portCount = 0;
        $labelCount = 0;

        $portX = $unitX + ($portWidth / 2);
        $portY = $unitY;

        $labelX = $unitX + ($portWidth * 1);
        $labelY = $unitY + ($portHeight * 0.75);

        $data = $json["data"];
        ?>

        {{--if vertical is true rearange array--}}
        @if($json["vertical"])
            <?php
            $output = [];

            $startIndex = 0;
            for ($column = $startIndex; $column < count($data[$startIndex]); $column++) {
                for ($row = $startIndex; $row < count($data); $row++) {
                    $output[$column][] = $data[$row][$column];
                }
            }
            $data = $output;
            ?>
        @endif



        @foreach ($data as $rowKey => $rowValue)

            @foreach ($rowValue as $columnKey => $columnValue)
                @if (strtoupper($columnValue) === strtoupper("L"))
                    @if ($labelCount <= $unit->ports->count())
                        <?php
                        $labelY2 = $labelY - 16;
                        $index = $labelCount++;
                        $port = $ports[$index];
                        ?>
                        @if ($debug)
                            <rect x="{{ $portX  }}" y="{{ $portY }}" width="{{ $portWidth }}" height="{{ $portHeight }}"
                                  style="stroke: #000;fill: rgba(255, 138, 0, 1);stroke-width:1px;fill-opacity:1;"></rect>
                            <text x="{{ $labelX }}" y="{{ $labelY2 }}" text-anchor="middle" class="port__label" style="fill: #dddddd;">{{ $port->id }}</text>
                        @endif
                        <?php
                            $labelText = str_limit($port->label, 6, '');
                            $fontSize = 1.3 - (strlen($labelText) * 0.05);
                            ?>
                        <text x="{{ $labelX }}" y="{{ $labelY }}" text-anchor="middle" class="port__label" style="font-size: {{ $fontSize }}rem">{{ $labelText }}</text>
                    @endif
                @endif

                @if (strtoupper($columnValue) === strtoupper("P"))
                    @if ($json["fiber"])
                        <?php $portHeight = ($unitHeight / (6 * $unit->type->unit_height)) * 3; ?>
                    @endif
                    <?php
                    $index = $portCount++;
                    $port = $ports[$index];
                    $portsArray[$port->id] = ['x' => $portX + ($portWidth / 2), 'y' => $portY + ($portHeight / 2)];
                    ?>
                    <text x="{{ $labelX }}" y="{{ $labelY }}" text-anchor="middle" class="port__label">{{ str_limit($port->label, 6, '') }}</text>
                    <text x="{{ $labelX }}" y="{{ $labelY - 16 }}" text-anchor="middle" class="port__label" style="fill: blue;">{{ $port->id }}</text>
                    <rect data-id="{{ $port->id }}" x="{{ $portX }}" y="{{ $portY }}" width="{{ $portWidth }}" height="{{ $portHeight }}"
                          style="stroke: #000;fill:#4CAF50;stroke-width:1px;fill-opacity:1;"></rect>
                @endif


                @if (!$json["vertical"])
                    <?php
                    $portX = $portX + $portWidth;
                    $labelX = $labelX + $portWidth;
                    ?>
                @else
                    <?php
                    $portY = $portY + $portHeight;
                    $labelY = $labelY + $portHeight;
                    ?>
                @endif

            @endforeach

            @if (!$json["vertical"])
                <?php
                $portX = $unitX + ($portWidth / 2);
                $portY = $portY + $portHeight;
                $labelX = $unitX + $portWidth;
                $labelY = $labelY + $portHeight;
                ?>
            @else
                <?php
                $portY = $unitY;
                $labelY = $unitY + ($portHeight * 0.75);
                $portX = $portX + $portWidth;
                $labelX = $labelX + $portWidth;
                ?>
            @endif
        @endforeach
    @endif
</g>

<?php $unitY = $unitY + $unitHeight; ?>
