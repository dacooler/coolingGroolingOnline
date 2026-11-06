import json
from typing import Any

from ..primitives.coord import Coord
from ..furniture.furniture import Furniture
from ..primitives.height_differences import HeightDifferences
from ..room.room import Room
from ..room.wall.wall_openings import WallOpenings
from ..room.wall.wall_argss import WallArgss
from ..primitives.size import Size
from ..primitives.part import Part
from ..primitives.html_element import HtmlElement
from ..primitives.style import Style
from .map_result import MapResult


class Map:
    floors: list[HtmlElement]
    rooms: list[Room]
    blocks: list[Part]
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

        for floor in self.floors:
            yield floor
        
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
        self.floors = []

    def load(self):
        self.rooms = []
        self.blocks = []
        self.furnitures = []
        self.floors = []

        self._load_objects()
        self._load_room()


    def _load_objects(self):
        with open('src/map.json') as file:
            map_data_raw = file.read()

        map_json = json.loads(map_data_raw)
        for object in map_json:
            self._parse_object(object)

    def _load_room(self):
        with open('src/rooms/room.json') as file:
            room_data_raw = file.read()

        room_json = json.loads(room_data_raw)
        self._parse_room(room_json)

    def _parse_object(self, object: dict[str, Any]):
        match object['type']:
            case "block":     self._parse_block(object)
            case "floor":     self._parse_floor(object)
            case "furniture": self._parse_and_add_furniture(object)
            case "size":      self.size = Size.from_json(object['size'])
            case type:        raise ValueError(f'invalid type "{type}" for object.')


    def _parse_block(self, block: dict[str, Any]):
        self.blocks.append(Part(
            Coord.from_json(block['position']),
            Size.from_json(block['size']),
            block['css_classes'],
        ))

    def _parse_room(self, room: dict[str, Any]):
        if "children" in room:
            children = [self._parse_furniture(child) for child in room["children"]]
        else:
            children = []

        self.rooms.append(Room(
            Coord.from_json(room['position']),
            Size.from_json(room['size']),
            room['css_classes'],
            20,
            WallOpenings.from_json(room['wall_openings']),
            self._parse_wall_args(room),
            children,
        ))

    def _parse_floor(self, floor: dict[str, Any]):
        pos = Coord.from_json(floor["position"])
        size = Size.from_json(floor["size"])

        self.floors.append(
            HtmlElement(
                style= [
                    Style(
                        "left", pos.x, "px"
                    ),
                    Style(
                        "top", pos.y, "px"
                    ),
                    Style(
                        "width", size.width, "px"
                    ),
                    Style(
                        "height", size.height, "px"
                    ),
                    Style(
                        "--rotation", floor["rotation"], "deg"
                    )

                ],
                css_classes= floor["css_classes"] + ["floor"]
            )
        )

    def _parse_wall_args(self, json: dict[str, Any]):
        try:
            return WallArgss.from_json(json['walls'])
        except KeyError:
            return WallArgss()

    def _parse_and_add_furniture(self, furniture: dict[str, Any]):
        self.furnitures.append(self._parse_furniture(furniture))

    def _parse_furniture(self, furniture: dict[str, Any]):
        return Furniture.from_json(furniture)

    def to_result(self):
        return MapResult(
            colliders='\n'.join((str(collider) for collider in self.collision_parts)),
            visual_cubes='\n'.join((str(visual_cube) for visual_cube in self.visual_parts)),
            size=self.size_2d,
            height_differences=self.height_differences.get_calcs(),
        )
