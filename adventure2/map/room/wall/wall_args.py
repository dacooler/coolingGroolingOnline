from typing import Any


class WallArgs:
    css_classes: list[str]
    args: list[str]

    def __init__(self, css_classes: list[str]=[], args: list[str]=[]):
        if css_classes:
            self.css_classes = css_classes
        else:
            self.css_classes = []

        if args:
            self.args = args
        else:
            self.args = []

    @classmethod
    def from_json(cls, json: dict[str, Any]):
        try:
            css_classes = json['css_classes']
        except:
            css_classes = []

        try:
            args = json['args']
        except:
            args = []

        return cls(css_classes, args)
