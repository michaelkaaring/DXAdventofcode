defmodule Aoc16.Day05Test do
  use ExUnit.Case, async: true

  test "part 1 example code" do
    input = "abc"
    assert Aoc16.Day05.calculate_password(input) == "18f47a30"
  end

  test "part 2 example code" do
    input = "abc"
    assert Aoc16.Day05.calculate_positional_password(input) == "05ace8e3"
  end
end
