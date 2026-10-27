from typing import Any

from ...coord import Coord
from ...size import Size
from .wall_openings import WallOpenings
from .wall import Wall
from .wall_args import WallArgs


class WallArgss:
    north: WallArgs | None
    south: WallArgs | None
    west: WallArgs | None
    east: WallArgs | None

    def __init__(self,
                 north: WallArgs | None=None,
                 south: WallArgs | None=None,
                 east: WallArgs | None=None,
                 west: WallArgs | None=None,
                 ):
        self.north = north
        self.south = south
        self.west = west
        self.east = east

    @classmethod
    def from_json(cls, json: list[dict[str, Any]]):
        north = south = west = east = None

        for wall_args in json:
            match wall_args['direction']:
                case 'north': north = WallArgs.from_json(wall_args)
                case 'south': south = WallArgs.from_json(wall_args)
                case 'west': west = WallArgs.from_json(wall_args)
                case 'east': east = WallArgs.from_json(wall_args)
        
        return cls(north, south, west, east)
        
    def to_wall_list(self, position: Coord, size: Size, wall_thickness: float, wall_openings: WallOpenings, css_classes: list[str]):
        return [
            Wall(
                position,
                Size(size.width, wall_thickness, size.depth),
                wall_openings.get_openings_of_wall(0),
                css_classes + ['north'] + (self.north.css_classes if self.north else []),
                True,
                self.north.args if self.north else [],
            ),
            Wall(
                position + (size.width, 0),
                Size(wall_thickness, size.height, size.depth),
                wall_openings.get_openings_of_wall(1),
                css_classes + ['east'] + (self.east.css_classes if self.east else []),
                False,
                self.east.args if self.east else [],
            ),
            Wall(
                position + (wall_thickness, size.height),
                Size(size.width, wall_thickness, size.depth),
                wall_openings.get_openings_of_wall(2),
                css_classes + ['south'] + (self.south.css_classes if self.south else []),
                True,
                self.south.args if self.south else [],
            ),
            Wall(
                position + (0, wall_thickness),
                Size(wall_thickness, size.height, size.depth),
                wall_openings.get_openings_of_wall(3),
                css_classes + ['west'] + (self.west.css_classes if self.west else []),
                False,
                self.west.args if self.west else [],
            ),
        ]
