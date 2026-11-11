import argparse
import json
import uuid
from types import SimpleNamespace
from typing import Any, Callable
from typing import Literal


class Position:
    x: float
    y: float

    def __init__(self, x: float | str, y: float | str):
        self.x = float(x)
        self.y = float(y)


class Size:
    width: float
    height: float
    depth: float


Direction = Literal["south"] | Literal["west"] | Literal["north"] | Literal["east"]


class Wall:
    direction: Direction
    args: list[str]


class WallOpening:
    type: Literal["door"] | Literal["window"]
    wall_index: Literal[0] | Literal[1] | Literal[2] | Literal[3]
    position: float
    width: float


class Furniture:
    type: Literal['furniture']
    furniture_type: str
    position: Position
    rotation: float
    children: None | list["Furniture"]
    id: str

    def __init__(self, furniture_type: str, position: Position, rotation: float, children: list["Furniture"], id: str | None = None):
        self.type = "furniture"
        self.furniture_type = furniture_type
        self.position = position
        self.rotation = rotation
        self.id = id

        if children:
            self.children = children



class RoomData:
    type: str
    position: Position
    size: Size
    css_classes: list[str]
    walls: list[Wall]
    wall_openings: list[WallOpening]
    children: list[Furniture]


file_name = 'src/rooms/room.json'


def load() -> RoomData:
    with open(file_name, 'r') as file:
        text = file.read()
        
    return json.loads(text, object_hook=SimpleNamespace)


def save(json_data: RoomData):
    text = json.dumps(json_data, default=lambda obj: vars(obj), indent=4)

    with open(file_name, 'w') as file:
        file.write(text)


def apply(func: Callable[[RoomData], RoomData]):
    json_data = load()
    json_data = func(json_data)
    save(json_data)


def place_furniture(furniture_type: str, x: float, y: float, rotation: float):
    apply(lambda json: _place_furniture(json, furniture_type, x, y, rotation))


def _place_furniture(json_data: RoomData, furniture_type: str, x: float, y: float, rotation: float):
    json_data.children.append(Furniture(
        furniture_type,
        Position(x, y),
        rotation,
        children=[],
        id=str(uuid.uuid4())
    ))
    return json_data


parser = argparse.ArgumentParser(
        prog='Editor',
        description='Edits the room.json file to make edits to rooms.')

parser.add_argument('furniture_type')
parser.add_argument('x')
parser.add_argument('y')
parser.add_argument('rotation')


if __name__ == '__main__':
    args = parser.parse_args()
    place_furniture(args.furniture_type, float(args.x), float(args.y), float(args.rotation))
