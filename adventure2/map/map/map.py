import json
from typing import Any

from ..coord import Coord
from ..furniture.furniture import Furniture
from ..height_differences import HeightDifferences
from ..room.room import Room
from ..room.wall.wall_openings import WallOpenings
from ..room.wall.wall_argss import WallArgss
from ..size import Size
from ..sized_part import SizedPart
from .map_result import MapResult


class Map:
    rooms: list[Room]
    blocks: list[SizedPart]
    furnitures: list[Furniture]
    size: Size

    @property
    def collision_parts(self):
        for room in self.rooms:
            for part in room.get_collision_rects():
                yield part.get_collision_rect()

        for block in self.blocks:
            yield block.get_collision_rect()

        for furniture in self.furnitures:
            if furniture.has_collision:
                yield furniture.part.get_collision_rect()
    
    @property
    def visual_parts(self):
        for room in self.rooms:
            for part in room.get_collision_rects():
                yield part.get_visual_cube()

        for room in self.rooms:
            yield room.floor
            for part in room.get_visual_cubes():
                yield part.get_visual_cube()

        for block in self.blocks:
            yield block.get_visual_cube()

        for furniture in self.furnitures:
            yield furniture.part.get_visual_cube()
        
    @property
    def size_2d(self):
        return (self.size.width, self.size.height)

    @property
    def height_differences(self):
        return HeightDifferences(
            (furniture.height_difference for furniture in self.furnitures)
        )

    def __init__(self):
        self.rooms = []
        self.blocks = []
        self.furnitures = []

    def load(self):
        self.rooms = []
        self.blocks = []
        self.furnitures = []

        with open('src/map.json') as file:
            map_data_raw = file.read()

        map_json = json.loads(map_data_raw)
        for object in map_json:
            match object['type']:
                case "block": self._parse_block(object)
                case "room": self._parse_room(object)
                case "furniture": self._parse_furniture(object)
                case "size": self.size = Size.from_json(object['size'])
                case type: raise ValueError(f'invalid type "{type}" for object.')

    def _parse_block(self, block: dict[str, Any]):
        self.blocks.append(SizedPart(
            Coord.from_json(block['position']),
            Size.from_json(block['size']),
            block['css_classes'],
        ))

    def _parse_room(self, room: dict[str, Any]):
        self.rooms.append(Room(
            Coord.from_json(room['position']),
            Size.from_json(room['size']),
            room['css_classes'],
            20,
            WallOpenings.from_json(room['wall_openings']),
            self._parse_wall_args(room),
        ))

    def _parse_wall_args(self, json: dict[str, Any]):
        try:
            return WallArgss.from_json(json['walls'])
        except KeyError:
            return WallArgss()

    def _parse_furniture(self, furniture: dict[str, Any]):
        self.furnitures.append(Furniture.from_json(furniture))

    def to_result(self):
        return MapResult(
            colliders='\n'.join((str(collider) for collider in self.collision_parts)),
            visual_cubes='\n'.join((str(visual_cube) for visual_cube in self.visual_parts)),
            size=self.size_2d,
            height_differences=self.height_differences.get_calcs(),
        )
