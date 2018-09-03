<?php
$radius = 16;
$stroke = '#000';
$fill = '#FFF';
$counter = 0;
$style = 'stroke-width:7;fill-opacity:0.4;stroke-opacity: 0.3';
$style_vlan = 'font-weight:bold;font-size: 1.2em; padding: 4px 2px 0px 2px;';
$tooltip_options = 'data-toggle="tooltip"';
?>
@foreach($patchcables as $patchcable)
    <?php
    $portA = $patchcable->portA;
    $portB = $patchcable->portB;
    ?>
    @if(array_key_exists($portA->id, $portsArray) || array_key_exists($portB->id, $portsArray))
        <g id="patchcable_{{ $patchcable->id }}" data-patchcableId="{{ $patchcable->id }}" data-portAId="{{ $portA->id }}" data-portBId="{{ $portB->id }}">
            <?php /** Do This if PortA Exists */ ?>
            @if(array_key_exists($portA->id, $portsArray))
                <?php
                $x1 = $portsArray[$portA->id]['x'];
                $y1 = $portsArray[$portA->id]['y'];
                $portATaggedVlan = (!is_null($portA->vlans()) ? $portA->vlans()->tagged()->first() : "");
                $portAUntaggedVlan = (!is_null($portA->vlans()) ? $portA->vlans()->untagged()->first() : "");
                $strokeA = ($portATaggedVlan) ? $portATaggedVlan->color : $stroke;
                $fillA = ($portAUntaggedVlan) ? $portAUntaggedVlan->color : $stroke;
                $rackA = $portB->unit->rack;
                $roomA = $rackA->room;
                ?>
                <a @if(!array_key_exists($portB->id, $portsArray)) xlink:href={{ route('rooms.racks.show', compact('roomA', 'rackA')) }} target="_top" @endif>
                    <circle cx="{{ $x1 }}" cy="{{ $y1 }}" r="{{ $radius }}" style="stroke:{{ $strokeA }}; fill:{{ $fillA }}; {{ $style }}"></circle>
                </a>
            @endif
            <?php /** Do This if PortB Exists */ ?>
            @if(array_key_exists($portB->id, $portsArray))
                <?php
                $x2 = $portsArray[$portB->id]['x'];
                $y2 = $portsArray[$portB->id]['y'];
                $portBTaggedVlan = (!is_null($portB->vlans()) ? $portB->vlans()->tagged()->first() : "");
                $portBUntaggedVlan = (!is_null($portB->vlans()) ? $portB->vlans()->untagged()->first() : "");
                $strokeB = ($portBTaggedVlan) ? $portBTaggedVlan->color : $stroke;
                $fillB = ($portBUntaggedVlan) ? $portBUntaggedVlan->color : $stroke;
                $rackB = $portA->unit->rack;
                $roomB = $rackB->room;
                ?>
                <a @if(!array_key_exists($portA->id, $portsArray)) xlink:href={{ route('rooms.racks.show', compact('roomB', 'rackB')) }} target="_top" @endif>
                    <circle cx="{{ $x2 }}" cy="{{ $y2 }}" r="{{ $radius }}" style="stroke:{{ $strokeB }}; fill:{{ $fillB }}; {{ $style }}"></circle>
                </a>
            @endif
            <?php /** Do This if PortA & PortB Exists */ ?>
            @if(array_key_exists($portA->id, $portsArray) && array_key_exists($portB->id, $portsArray))
                <?php
                $x1 = $portsArray[$portA->id]['x'];
                $y1 = $portsArray[$portA->id]['y'];
                $x2 = $portsArray[$portB->id]['x'];
                $y2 = $portsArray[$portB->id]['y'];

                $offset = 12;
                $distance = 75;

                if ($y1 < $y2) {
                    $y1 += $offset; $y2 -= $offset;
                } else if ($y1 == $y2) {
                } else {
                    $y1 -= $offset; $y2 += $offset;
                }

                if ($y1 == $y2) {
                    $x1 += $offset + 5; $x2 -= $offset + 5;
                } else {
                    if ($x1 < $x2) {
                        if ($x2 - $x1 > $distance) {
                            $x1 += $offset; $x2 -= $offset;
                        }
                    } else if ($x1 - $x2 > $distance) {
                        $x1 -= $offset; $x2 += $offset;
                    }
                }
                ?>
                <line x1="{{ $x1 }}" y1="{{ $y1 }}" x2="{{ $x2 }}" y2="{{ $y2 }}" class="patchcable"></line>
            @endif
        </g>
    @endif
@endforeach
